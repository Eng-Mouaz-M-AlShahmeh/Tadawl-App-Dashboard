<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;

use App\Models\REOffice;

use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class AppREOfficesController extends Controller
{

    private $uploadPath = "API22544445213/assets/images/offices/";

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

            $REOffices = REOffice::all();
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->get();

            $REOffices = REOffice::all();
        }
        return view("dashboard.appREOffices.list", compact("Users", "Permissions", "REOffices", "search_word", "GeneralWebmasterSections"));
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
        
        $REOffice = REOffice::find($id);

        return view("dashboard.appREOffices.show", compact("GeneralWebmasterSections", "Permissions", "REOffice"));
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
                //find REOffices

                $REOffices = REOffice::where('office_name', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('sejel', '=', $request->q)
                    ->orwhere('phone_user', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all REOffices
                $REOffices = REOffice::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($request->q != "") {
              //find REOffices

              $REOffices = REOffice::where('office_name', 'like',
              '%' . $request->q . '%')
              ->orwhere('sejel', '=', $request->q)
              ->orwhere('phone_user', '=', $request->q)
              ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
               //List of all REOffices
               $REOffices = REOffice::all()->orderby('id',
               'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }
      
        $search_word = $request->q;

        return view("dashboard.appREOffices.list",
            compact("REOffices", "GeneralWebmasterSections", "search_word"));
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

        return view("dashboard.appREOffices.create", compact("GeneralWebmasterSections", "Permissions"));
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
        ]);


        // Start of Upload Files
        $formFileName = "sejel_image";
        $fileFinalName_ar = "";
        if ($request->$formFileName != "") {
            $fileFinalName_ar = time() . rand(1111,
                    9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
            $path = $this->getUploadPath();
            $request->file($formFileName)->move($path, $fileFinalName_ar);
        }
        // End of Upload Files

        $REOffices = new REOffice;
        $REOffices->office_name = $request->office_name;
        $REOffices->office_lat = $request->office_lat;
        $REOffices->office_lng = $request->office_lng;
        $REOffices->sejel = $request->sejel;
        $REOffices->phone_user = $request->phone_user;
        $REOffices->sejel_image = $fileFinalName_ar;
        $REOffices->state = 0;
        $REOffices->save();

        return redirect()->action('Dashboard\AppREOfficesController@index')->with('doneMessage', __('backend.addDone'));
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
            $REOffice = REOffice::find($id);
        } else {
            $REOffice = REOffice::find($id);
        }
        if (!empty($REOffice)) {
            return view("dashboard.appREOffices.edit", compact("REOffice", "Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\AppREOfficesController@index');
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
        $REOffice = REOffice::find($id);
        if (!empty($REOffice)) {


            $this->validate($request, [

            ]);

            // Start of Upload Files
            $formFileName = "sejel_image";
            $fileFinalName_ar = "";
            if ($request->$formFileName != "") {
                $fileFinalName_ar = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                $path = $this->getUploadPath();
                $request->file($formFileName)->move($path, $fileFinalName_ar);
            }
            // End of Upload Files
            
            if ($request->office_name != "") {
                $REOffice->office_name = $request->office_name;
            }
            
            if ($request->office_lat != "") {
                $REOffice->office_lat = $request->office_lat;
            }
            
            if ($request->office_lng != "") {
                $REOffice->office_lng = $request->office_lng;
            }
            
            
            if ($request->sejel != "") {
                $REOffice->sejel = $request->sejel;
            }
            
            if ($request->phone_user != "") {
                $REOffice->phone_user = $request->phone_user;
            }
            
            if ($request->photo_delete == 1) {
                // Delete a User file
                if ($REOffice->sejel_image != "") {
                    File::delete($this->getUploadPath() . $REOffice->sejel_image);
                }

                $REOffice->sejel_image = "";
            }
            if ($fileFinalName_ar != "") {
                // Delete a REOffice file
                if ($REOffice->sejel_image != "") {
                    File::delete($this->getUploadPath() . $REOffice->sejel_image);
                }

                $REOffice->sejel_image = $fileFinalName_ar;
            }

            if ($request->state != "") {
                $REOffice->state = $request->state;
            }

            $REOffice->save();
            return redirect()->action('Dashboard\AppREOfficesController@edit', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\AppREOfficesController@index');
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
            $REOffice = REOffice::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $REOffice = REOffice::find($id);
        }
        if (!empty($REOffice) && $id != 1) {

            $REOffice->delete();
            return redirect()->action('Dashboard\AppREOfficesController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\AppREOfficesController@index');
        }
    }


  
}
