<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;
use App\Models\UserApp;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class AppUsersController extends Controller
{

    private $uploadPath = "API22544445213/assets/images/avatar/";

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }
    
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
        $search_word="";
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if (@Auth::user()->permissionsGroup->view_status) {
            $Users = User::where('created_by', '=', Auth::user()->id)->orwhere('id', '=', Auth::user()->id)->orderby('id',
                'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::where('created_by', '=', Auth::user()->id)->orderby('id', 'asc')->get();
            $UsersApp = UserApp::all();
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->get();
            $UsersApp = UserApp::all();
        }
        return view("dashboard.appUsers.list", compact("Users", "Permissions", "UsersApp", "search_word", "GeneralWebmasterSections"));
    }
    
    
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END
        $Permissions = Permissions::orderby('id', 'asc')->get();
        
        $UserApp = UserApp::find($id);

        return view("dashboard.appUsers.show", compact("GeneralWebmasterSections", "Permissions", "UserApp"));
    }
    
    
      /**
     * Search resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END


        if (@Auth::user()->permissionsGroup->view_status) {
            if ($request->q != "") {
                //find Users

                $UsersApp = UserApp::where('username', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('company_name', 'like', '%' . $request->q . '%')
                    ->orwhere('office_name', 'like', '%' . $request->q . '%')
                    ->orwhere('about', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all users
                $UsersApp = UserApp::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($request->q != "") {
              //find Users

                $UsersApp = UserApp::where('username', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('company_name', 'like', '%' . $request->q . '%')
                    ->orwhere('office_name', 'like', '%' . $request->q . '%')
                    ->orwhere('about', 'like', '%' . $request->q . '%')
                    ->orwhere('phone', '=', $request->q)
                    ->orwhere('email', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
               //List of all users
                $UsersApp = UserApp::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }
      
        $search_word = $request->q;

        return view("dashboard.appUsers.list",
            compact("UsersApp", "GeneralWebmasterSections", "search_word"));
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

        return view("dashboard.appUsers.create", compact("GeneralWebmasterSections", "Permissions"));
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
            //'photo' => 'mimes:png,jpeg,jpg,gif,svg',
            //'name' => 'required',
            //'email' => 'required|email|unique:users',
            //'password' => 'required',
            //'permissions_id' => 'required'
        ]);


        // Start of Upload Files
        $formFileName = "image";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        // End of Upload Files

        $UsersApp = new UserApp;
        $UsersApp->username = $request->username;
        $UsersApp->phone = $request->phone;
        $UsersApp->password = $request->password;
        $UsersApp->rePassword = $request->rePassword;
        //bcrypt($request->password);
        $UsersApp->company_name = $request->company_name;
        $UsersApp->image = $fileFinalName_ar;
        $UsersApp->email = $request->email;
        $UsersApp->office_name = $request->office_name;
        $UsersApp->about = $request->about;
        $UsersApp->verified = 1;
        //$UsersApp->created_by = Auth::user()->id;
        $UsersApp->save();

        return redirect()->action('Dashboard\AppUsersController@index')->with('doneMessage', __('backend.addDone'));
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
            $UserApp = UserApp::find($id);
        } else {
            $UserApp = UserApp::find($id);
        }
        if (!empty($UserApp)) {
            return view("dashboard.appUsers.edit", compact("UserApp", "Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\AppUsersController@index');
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
        $UserApp = UserApp::find($id);
        if (!empty($UserApp)) {


            $this->validate($request, [
                //'image' => 'mimes:png,jpeg,jpg,gif,svg',
                //'username' => 'required',
                //'phone' => 'required|unique:user',
                //'password' => 'required|min:8|same:rePassword',
                //'rePassword' => 'required|min:8|',
                //'about' => 'required',

            ]);

            if ($request->email != $UserApp->email) {
                $this->validate($request, [
                  //  'email' => 'required|email',
                ]);
            }
            // Start of Upload Files
            $formFileName = "image";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            // End of Upload Files

            //if ($id != 1) {
            
            if ($request->username != "") {
                $UserApp->username = $request->username;
            }
            
            if ($request->phone != "") {
                $UserApp->phone = $request->phone;
            }
            
            if ($request->about != "") {
                $UserApp->about = $request->about;
            }
            
            
            if ($request->company_name != "") {
                $UserApp->company_name = $request->company_name;
            }
            
            if ($request->office_name != "") {
                $UserApp->office_name = $request->office_name;
            }
            
             if ($request->email != "") {
                $UserApp->email = $request->email;
            }
            
            
            if ($request->password != "") {
                $UserApp->password = bcrypt($request->password);
                $UserApp->rePassword = bcrypt($request->rePassword);
            }
            //$User->permissions_id = $request->permissions_id;
            //}
            if ($request->photo_delete == 1) {
                // Delete a User file
                if ($UserApp->image != "") {
                    File::delete($this->getUploadPath() . $UserApp->image);
                }

                $UserApp->image = "";
            }
            if ($fileFinalName_ar != "") {
                // Delete a User file
                if ($UserApp->image != "") {
                    File::delete($this->getUploadPath() . $UserApp->image);
                }

                $UserApp->image = $fileFinalName_ar;
            }

            if ($request->verified != "") {
                $UserApp->verified = $request->verified;
            }
            
            //$User->updated_by = Auth::user()->id;
            $UserApp->save();
            return redirect()->action('Dashboard\AppUsersController@edit', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\AppUsersController@index');
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
            $User = UserApp::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $User = UserApp::find($id);
        }
        if (!empty($User) && $id != 1) {
            // Delete a User photo
            //if ($User->photo != "") {
            //    File::delete($this->getUploadPath() . $User->photo);
            //}

            $User->delete();
            return redirect()->action('Dashboard\AppUsersController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\AppUsersController@index');
        }
    }


  
}
