<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\WebmasterBanner;
use App\Models\WebmasterSection;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use File;
use Helper;

class WebmasterBannersController extends Controller
{


    private $uploadPath = "uploads/banners/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0) {
            return Redirect::to(route('NoPermission'))->send();
        }
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
            $WebmasterBanners = WebmasterBanner::where('created_by', '=', Auth::user()->id)->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $WebmasterBanners = WebmasterBanner::orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("dashboard.webmaster.banners.list", compact("WebmasterBanners", "GeneralWebmasterSections"));
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

        return view("dashboard.webmaster.banners.create", compact("GeneralWebmasterSections"));
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

        $next_nor_no = WebmasterBanner::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }
        $WebmasterBanner = new WebmasterBanner;
        $WebmasterBanner->row_no = $next_nor_no;
        foreach (Helper::languagesList() as $ActiveLanguage) {
            $WebmasterBanner->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
        }
        $WebmasterBanner->width = $request->width;
        $WebmasterBanner->height = $request->height;
        $WebmasterBanner->desc_status = $request->desc_status;
        $WebmasterBanner->link_status = $request->link_status;
        $WebmasterBanner->icon_status = $request->icon_status;
        $WebmasterBanner->type = $request->type;
        $WebmasterBanner->status = 1;
        $WebmasterBanner->created_by = Auth::user()->id;
        $WebmasterBanner->save();

        return redirect()->action('Dashboard\WebmasterBannersController@index')->with('doneMessage', __('backend.addDone'));
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
        if (@Auth::user()->permissionsGroup->view_status) {
            $WebmasterBanners = WebmasterBanner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterBanners = WebmasterBanner::find($id);
        }
        if (!empty($WebmasterBanners)) {
            return view("dashboard.webmaster.banners.edit", compact("WebmasterBanners", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\WebmasterBannersController@index');
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
        $WebmasterBanner = WebmasterBanner::find($id);
        if (!empty($WebmasterBanner)) {
            foreach (Helper::languagesList() as $ActiveLanguage) {
                $WebmasterBanner->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
            }
            $WebmasterBanner->width = $request->width;
            $WebmasterBanner->height = $request->height;
            $WebmasterBanner->desc_status = $request->desc_status;
            $WebmasterBanner->link_status = $request->link_status;
            $WebmasterBanner->icon_status = $request->icon_status;
            $WebmasterBanner->type = $request->type;
            $WebmasterBanner->status = $request->status;
            $WebmasterBanner->updated_by = Auth::user()->id;
            $WebmasterBanner->save();
            return redirect()->action('Dashboard\WebmasterBannersController@edit', $id)->with('doneMessage',
                __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\WebmasterBannersController@index');
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
            $WebmasterBanner = WebmasterBanner::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterBanner = WebmasterBanner::find($id);
        }
        if (!empty($WebmasterBanner)) {

            //delete banners
            if (count($WebmasterBanner->banners) > 0) {
                foreach ($WebmasterBanner->banners as $Banner) {
                    // Delete a banner file
                    if ($Banner->file_ar != "") {
                        File::delete($this->getUploadPath() . $Banner->file_ar);
                    }
                    if ($Banner->file_en != "") {
                        File::delete($this->getUploadPath() . $Banner->file_en);
                    }
                    $Banner->delete();
                }
            }

            $WebmasterBanner->delete();
            return redirect()->action('Dashboard\WebmasterBannersController@index')->with('doneMessage',
                __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\WebmasterBannersController@index');
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
        if ($request->action == "order") {
            foreach ($request->row_ids as $rowId) {
                $WebmasterBanner = WebmasterBanner::find($rowId);
                if (!empty($WebmasterBanner)) {
                    $row_no_val = "row_no_" . $rowId;
                    $WebmasterBanner->row_no = $request->$row_no_val;
                    $WebmasterBanner->save();
                }
            }

        } else {
            if ($request->ids != "") {
                if ($request->action == "activate") {
                    WebmasterBanner::wherein('id', $request->ids)
                        ->update(['status' => 1]);

                } elseif ($request->action == "block") {
                    WebmasterBanner::wherein('id', $request->ids)
                        ->update(['status' => 0]);

                } elseif ($request->action == "delete") {

                    $WebmasterBanners = WebmasterBanner::wherein('id', $request->ids)->get();
                    foreach ($WebmasterBanners as $WebmasterBanner) {
                        //delete banners
                        if (count($WebmasterBanner->banners) > 0) {
                            foreach ($WebmasterBanner->banners as $Banner) {
                                // Delete a banner file
                                if ($Banner->file_ar != "") {
                                    File::delete($this->getUploadPath() . $Banner->file_ar);
                                }
                                if ($Banner->file_en != "") {
                                    File::delete($this->getUploadPath() . $Banner->file_en);
                                }
                                $Banner->delete();
                            }
                        }
                    }

                    WebmasterBanner::wherein('id', $request->ids)
                        ->delete();

                }
            }
        }
        return redirect()->action('Dashboard\WebmasterBannersController@index')->with('doneMessage', __('backend.saveDone'));
    }


}
