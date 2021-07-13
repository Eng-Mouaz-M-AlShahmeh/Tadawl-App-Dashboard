<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class UsersController extends Controller
{

    private $uploadPath = "uploads/users/";

    // Define Default Variables

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Users = User::where('created_by', '=', Auth::user()->id)->orwhere('id', '=', Auth::user()->id)->orderby('id',
                'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->get();
        }
        return view("dashboard.users.list", compact("Users", "Permissions", "GeneralWebmasterSections"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        $Permissions = Permissions::orderby('id', 'asc')->get();

        return view("dashboard.users.create", compact("GeneralWebmasterSections", "Permissions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'photo' => 'mimes:png,jpeg,jpg,gif,svg',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'permissions_id' => 'required'
        ]);


        // Start of Upload Files
        $formFileName = "photo";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        // End of Upload Files

        $User = new User;
        $User->name = $request->name;
        $User->email = $request->email;
        $User->password = bcrypt($request->password);
        $User->permissions_id = $request->permissions_id;
        $User->photo = $fileFinalName_ar;
        $User->connect_email = $request->connect_email;
        $User->connect_password = $request->connect_password;
        $User->status = 1;
        $User->created_by = Auth::user()->id;
        $User->save();

        return redirect()->action('Dashboard\UsersController@index')->with('doneMessage', __('backend.addDone'));
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        $Permissions = Permissions::orderby('id', 'asc')->get();

        if (@Auth::user()->permissionsGroup->view_status) {
            $Users = User::where('created_by', '=', Auth::user()->id)->orwhere('id', '=', Auth::user()->id)->find($id);
        } else {
            $Users = User::find($id);
        }
        if (!empty($Users)) {
            return view("dashboard.users.edit", compact("Users", "Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $User = User::find($id);
        if (!empty($User)) {


            $this->validate($request, [
                'photo' => 'mimes:png,jpeg,jpg,gif,svg',
                'name' => 'required',
                'permissions_id' => 'required'
            ]);

            if ($request->email != $User->email) {
                $this->validate($request, [
                    'email' => 'required|email|unique:users',
                ]);
            }
            // Start of Upload Files
            $formFileName = "photo";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            // End of Upload Files

            //if ($id != 1) {
            $User->name = $request->name;
            $User->email = $request->email;
            if ($request->password != "") {
                $User->password = bcrypt($request->password);
            }
            $User->permissions_id = $request->permissions_id;
            //}
            if ($request->photo_delete == 1) {
                // Delete a User file
                if ($User->photo != "") {
                    File::delete($this->getUploadPath() . $User->photo);
                }

                $User->photo = "";
            }
            if ($fileFinalName_ar != "") {
                // Delete a User file
                if ($User->photo != "") {
                    File::delete($this->getUploadPath() . $User->photo);
                }

                $User->photo = $fileFinalName_ar;
            }

            $User->connect_email = $request->connect_email;
            if ($request->connect_password != "") {
                $User->connect_password = $request->connect_password;
            }

            $User->status = $request->status;
            $User->updated_by = Auth::user()->id;
            $User->save();
            return redirect()->action('Dashboard\UsersController@edit', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $User = User::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $User = User::find($id);
        }
        if (!empty($User) && $id != 1) {
            // Delete a User photo
            if ($User->photo != "") {
                File::delete($this->getUploadPath() . $User->photo);
            }

            $User->delete();
            return redirect()->action('Dashboard\UsersController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param buttonNames , array $ids[]
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Request $request)
    {
        //
        if ($request->ids != "") {
            if ($request->action == "activate") {
                User::wherein('id', $request->ids)
                    ->update(['status' => 1]);

            } elseif ($request->action == "block") {
                User::wherein('id', $request->ids)->where('id', '!=', 1)
                    ->update(['status' => 0]);

            } elseif ($request->action == "delete") {
                // Delete User photo
                $Users = User::wherein('id', $request->ids)->where('id', '!=', 1)->get();
                foreach ($Users as $User) {
                    if ($User->photo != "") {
                        File::delete($this->getUploadPath() . $User->photo);
                    }
                }

                User::wherein('id', $request->ids)->where('id', "!=", 1)
                    ->delete();

            }
        }
        return redirect()->action('Dashboard\UsersController@index')->with('doneMessage', __('backend.saveDone'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissions_create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        return view("dashboard.permissions.create", compact("GeneralWebmasterSections"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function permissions_store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data_sections_values = "";
        if (@$request->data_sections != "") {
            foreach ($request->data_sections as $key => $val) {
                $data_sections_values = $val . "," . $data_sections_values;
            }
            $data_sections_values = substr($data_sections_values, 0, -1);
        }

        $Permissions = new Permissions;
        $Permissions->name = $request->name;
        $Permissions->view_status = ($request->view_status) ? "1" : "0";
        $Permissions->add_status = ($request->add_status) ? "1" : "0";
        $Permissions->edit_status = ($request->edit_status) ? "1" : "0";
        $Permissions->delete_status = ($request->delete_status) ? "1" : "0";
        $Permissions->active_status = ($request->active_status) ? "1" : "0";
        $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
        $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
        $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
        $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
        $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
        $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
        $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
        $Permissions->data_sections = $data_sections_values;
        $Permissions->home_status = 0;
        $Permissions->status = true;
        $Permissions->save();

        return redirect()->action('Dashboard\UsersController@index')->with('doneMessage', __('backend.addDone'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_edit($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = Permissions::find($id);
        }
        if (!empty($Permissions)) {
            return view("dashboard.permissions.edit", compact("Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_update(Request $request, $id)
    {
        //
        $Permissions = Permissions::find($id);
        if (!empty($Permissions)) {


            $this->validate($request, [
                'name' => 'required'
            ]);

            $data_sections_values = "";
            if (@$request->data_sections != "") {
                foreach ($request->data_sections as $key => $val) {
                    $data_sections_values = $val . "," . $data_sections_values;
                }
                $data_sections_values = substr($data_sections_values, 0, -1);
            }

            $Permissions->name = $request->name;
            $Permissions->view_status = ($request->view_status) ? "1" : "0";
            $Permissions->add_status = ($request->add_status) ? "1" : "0";
            $Permissions->edit_status = ($request->edit_status) ? "1" : "0";
            $Permissions->delete_status = ($request->delete_status) ? "1" : "0";
            $Permissions->active_status = ($request->active_status) ? "1" : "0";
            $Permissions->analytics_status = ($request->analytics_status) ? "1" : "0";
            $Permissions->inbox_status = ($request->inbox_status) ? "1" : "0";
            $Permissions->newsletter_status = ($request->newsletter_status) ? "1" : "0";
            $Permissions->calendar_status = ($request->calendar_status) ? "1" : "0";
            $Permissions->banners_status = ($request->banners_status) ? "1" : "0";
            if ($id != 1) {
                $Permissions->settings_status = ($request->settings_status) ? "1" : "0";
                $Permissions->webmaster_status = ($request->webmaster_status) ? "1" : "0";
            }
            $Permissions->data_sections = $data_sections_values;

            $Permissions->status = $request->status;
            $Permissions->save();
            return redirect()->action('Dashboard\UsersController@permissions_edit', $id)->with('doneMessage',
                __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function permissions_destroy($id)
    {
        //
        if (@Auth::user()->permissionsGroup->view_status) {
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Permissions = Permissions::find($id);
        }
        if (!empty($Permissions) && $id != 1) {
            User::where('permissions_id', $id)->delete();
            $Permissions->delete();
            return redirect()->action('Dashboard\UsersController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }


    public function update_custom_home(Request $request, $id)
    {
        //
        $Permissions = Permissions::find($id);
        if (!empty($Permissions)) {
            $Permissions->home_status = ($request->home_status) ? "1" : "0";

            foreach (Helper::languagesList() as $ActiveLanguage) {
                if ($ActiveLanguage->box_status) {
                    $Permissions->{"home_details_" . $ActiveLanguage->code} = $request->{"home_details_" . $ActiveLanguage->code};
                }
            }

            $saved_home_links = [];
            if ($Permissions->home_links != "") {
                try {
                    $saved_home_links = json_decode($Permissions->home_links);
                } catch (\Exception $e) {
                    $saved_home_links = [];
                }
            }

            $home_links = [];
            try {
                if (count($saved_home_links) > 0) {
                    foreach ($saved_home_links as $key => $saved_home_link) {
                        $row_no_val = "row_no_" . $saved_home_link->btn_id;
                        $link_details = [
                            "btn_id" => @$saved_home_link->btn_id,
                            "btn_link" => @$saved_home_link->btn_link,
                            "btn_class" => @$saved_home_link->btn_class,
                            "btn_order" => $request->$row_no_val,
                            "btn_target" => @$saved_home_link->btn_target,
                        ];

                        foreach (Helper::languagesList() as $ActiveLanguage) {
                            if ($ActiveLanguage->box_status) {
                                $link_details["btn_title_" . $ActiveLanguage->code] = @$saved_home_link->{"btn_title_" . $ActiveLanguage->code};
                            }
                        }
                        $home_links[] = $link_details;
                    }

                    usort($home_links, function ($a, $b) {
                        return $a['btn_order'] <=> $b['btn_order'];
                    });
                }

                $home_links = json_encode($home_links);
                $Permissions->home_links = $home_links;
            } catch (\Exception $e) {

            }

            $Permissions->save();
            return redirect()->action('Dashboard\UsersController@permissions_edit', $id)->with('doneMessage',
                __('backend.saveDone'))->with('tab', "home");
        } else {
            return redirect()->action('Dashboard\UsersController@index');
        }
    }


    public function links_store(Request $request)
    {
        //
        $Permissions = Permissions::find($request->permission_id);
        if (!empty($Permissions)) {
            if ($request->link == "") {
                return response()->json(['stat' => 'error', 'error' => [__('backend.completeLinkDetails')]]);
            }
            //
            $saved_home_links = [];
            if ($Permissions->home_links != "") {
                try {
                    $saved_home_links = json_decode($Permissions->home_links);
                } catch (\Exception $e) {
                    $saved_home_links = [];
                }
            }
            $home_links = [];
            try {
                $row_no = 1;
                if (!empty($saved_home_links) > 0) {
                    foreach ($saved_home_links as $key => $saved_home_link) {
                        $link_details = [
                            "btn_id" => @$saved_home_link->btn_id,
                            "btn_link" => @$saved_home_link->btn_link,
                            "btn_class" => @$saved_home_link->btn_class,
                            "btn_order" => @$saved_home_link->btn_order,
                            "btn_target" => @$saved_home_link->btn_target,
                        ];

                        foreach (Helper::languagesList() as $ActiveLanguage) {
                            if ($ActiveLanguage->box_status) {
                                $link_details["btn_title_" . $ActiveLanguage->code] = @$saved_home_link->{"btn_title_" . $ActiveLanguage->code};
                            }
                        }
                        $home_links[] = $link_details;
                        $row_no = @$saved_home_link->btn_order + 1;
                    }
                }

                $new_link_details = [
                    "btn_id" => uniqid(),
                    "btn_link" => $request->link,
                    "btn_class" => $request->btn_class,
                    "btn_order" => $row_no,
                    "btn_target" => ($request->target) ? 1 : 0,
                ];

                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($ActiveLanguage->box_status) {
                        $new_link_details["btn_title_" . $ActiveLanguage->code] = $request->{"btn_title_" . $ActiveLanguage->code};
                    }
                }
                $home_links[] = $new_link_details;

                $home_links = json_encode($home_links);
                $Permissions->home_links = $home_links;
                $Permissions->save();

                return response()->json(['stat' => 'success']);
            } catch (\Exception $e) {
            }
        }

        return response()->json(['stat' => 'error', 'error' => [__('backend.error')]]);
    }

    public function links_destroy($id = "", $p_id = 0)
    {
        if ($id != "") {
            $Permissions = Permissions::find($p_id);
            if (!empty($Permissions)) {

                if ($Permissions->home_links != "") {
                    try {
                        $saved_home_links = json_decode($Permissions->home_links);
                    } catch (\Exception $e) {
                        $saved_home_links = [];
                    }
                }
                try {
                    $home_links = [];
                    if (count($saved_home_links) > 0) {
                        foreach ($saved_home_links as $key => $saved_home_link) {
                            if ($saved_home_link->btn_id != $id) {

                                $link_details = [
                                    "btn_id" => @$saved_home_link->btn_id,
                                    "btn_link" => @$saved_home_link->btn_link,
                                    "btn_class" => @$saved_home_link->btn_class,
                                    "btn_order" => @$saved_home_link->btn_order,
                                    "btn_target" => @$saved_home_link->btn_target,
                                ];

                                foreach (Helper::languagesList() as $ActiveLanguage) {
                                    if ($ActiveLanguage->box_status) {
                                        $link_details["btn_title_" . $ActiveLanguage->code] = @$saved_home_link->{"btn_title_" . $ActiveLanguage->code};
                                    }
                                }
                                $home_links[] = $link_details;
                            }
                        }
                    }


                    $home_links = json_encode($home_links);
                    $Permissions->home_links = $home_links;
                    $Permissions->save();

                    return response()->json(['stat' => 'success']);
                } catch (\Exception $e) {
                }
            }
        }
        return response()->json(['stat' => 'error', 'error' => [trans('backLang.erorr')]]);
    }

    public function links_list($p_id = 0)
    {
        $saved_home_links = [];
        $Permissions = Permissions::find($p_id);
        if (!empty($Permissions)) {

            if ($Permissions->home_links != "") {
                try {
                    $saved_home_links = json_decode($Permissions->home_links);
                } catch (\Exception $e) {
                    $saved_home_links = [];
                }
            }
            $home_links = [];
            try {
                if (count($saved_home_links) > 0) {
                    foreach ($saved_home_links as $key => $saved_home_page_button) {
                        $link_details = [
                            "btn_id" => $saved_home_page_button->btn_id,
                            "btn_link" => $saved_home_page_button->btn_link,
                            "btn_class" => $saved_home_page_button->btn_class,
                            "btn_order" => $saved_home_page_button->btn_order,
                            "btn_target" => @$saved_home_page_button->btn_target,
                        ];
                        foreach (Helper::languagesList() as $ActiveLanguage) {
                            if ($ActiveLanguage->box_status) {
                                $link_details["btn_title_" . $ActiveLanguage->code] = $saved_home_page_button->{"btn_title_" . $ActiveLanguage->code};
                            }
                        }
                        $home_links[] = $link_details;
                    }
                    usort($home_links, function ($a, $b) {
                        return $a['btn_order'] <=> $b['btn_order'];
                    });
                }

                $home_links = json_encode($home_links);
                $home_links = json_decode($home_links);
            } catch (\Exception $e) {

            }
        }
        return view("dashboard.permissions.home.links.list", compact("Permissions", "home_links"));
    }

    public function links_edit($id = "", $p_id = 0)
    {
        $saved_home_links = [];
        $home_page_button = [];
        $Permissions = Permissions::find($p_id);
        if (!empty($Permissions)) {

            if ($Permissions->home_links != "") {
                try {
                    $saved_home_links = json_decode($Permissions->home_links);
                } catch (\Exception $e) {
                    $saved_home_links = [];
                }
            }
            try {
                if (count($saved_home_links) > 0) {
                    foreach ($saved_home_links as $key => $saved_home_link) {
                        if ($id == $saved_home_link->btn_id) {
                            $home_page_button = [
                                "btn_id" => @$saved_home_link->btn_id,
                                "btn_link" => @$saved_home_link->btn_link,
                                "btn_class" => @$saved_home_link->btn_class,
                                "btn_order" => @$saved_home_link->btn_order,
                                "btn_target" => @$saved_home_link->btn_target,
                            ];

                            foreach (Helper::languagesList() as $ActiveLanguage) {
                                if ($ActiveLanguage->box_status) {
                                    $home_page_button["btn_title_" . $ActiveLanguage->code] = @$saved_home_link->{"btn_title_" . $ActiveLanguage->code};
                                }
                            }
                        }
                    }
                }
            } catch (\Exception $e) {

            }
        }
        return view("dashboard.permissions.home.links.edit", compact("home_page_button", "Permissions"));
    }

    public function links_update(Request $request)
    {
        //
        $Permissions = Permissions::find($request->p_id);
        if (!empty($Permissions)) {
            if ($request->link == "") {
                return response()->json(['stat' => 'error', 'error' => [__('backend.completeLinkDetails')]]);
            }

            //
            if ($Permissions->home_links != "") {
                try {
                    $saved_home_links = json_decode($Permissions->home_links);
                } catch (\Exception $e) {
                    $saved_home_links = [];
                }
            }
            $home_links = [];
            try {
                $row_no = 1;
                if (!empty($saved_home_links) > 0) {
                    foreach ($saved_home_links as $key => $saved_home_link) {

                        if ($request->id == @$saved_home_link->btn_id) {


                            $new_link_details = [
                                "btn_id" => uniqid(),
                                "btn_link" => $request->link,
                                "btn_class" => $request->btn_class,
                                "btn_order" => $row_no,
                                "btn_target" => ($request->target) ? 1 : 0,
                            ];

                            foreach (Helper::languagesList() as $ActiveLanguage) {
                                if ($ActiveLanguage->box_status) {
                                    $new_link_details["btn_title_" . $ActiveLanguage->code] = $request->{"btn_title_" . $ActiveLanguage->code};
                                }
                            }
                            $home_links[] = $new_link_details;
                            $row_no++;

                        } else {
                            $link_details = [
                                "btn_id" => @$saved_home_link->btn_id,
                                "btn_link" => @$saved_home_link->btn_link,
                                "btn_class" => @$saved_home_link->btn_class,
                                "btn_order" => @$saved_home_link->btn_order,
                                "btn_target" => @$saved_home_link->btn_target,
                            ];

                            foreach (Helper::languagesList() as $ActiveLanguage) {
                                if ($ActiveLanguage->box_status) {
                                    $link_details["btn_title_" . $ActiveLanguage->code] = @$saved_home_link->{"btn_title_" . $ActiveLanguage->code};
                                }
                            }
                            $home_links[] = $link_details;
                            $row_no = $saved_home_link->btn_order + 1;
                        }

                    }
                }

                $home_links = json_encode($home_links);
                $Permissions->home_links = $home_links;
                $Permissions->save();

                return response()->json(['stat' => 'success']);
            } catch (\Exception $e) {
            }
        }

        return response()->json(['stat' => 'error', 'error' => [__('backend.error')]]);
    }
}
