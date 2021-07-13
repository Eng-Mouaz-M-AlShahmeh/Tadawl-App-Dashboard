<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;

use App\Models\ContactUs;

use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class AppContactController extends Controller
{

    //private $uploadPath = "API22544445213/assets/images/offices/";

    //public function getUploadPath()
    //{
    //    return $this->uploadPath;
    //}

    //public function setUploadPath($uploadPath)
    //{
    //    $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    //}
    
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

            $ContactUss = ContactUs::all();
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->get();

            $ContactUss = ContactUs::all();
        }
        return view("dashboard.appContact.list", compact("Users", "Permissions", "ContactUss", "search_word", "GeneralWebmasterSections"));
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
        
        $ContactUs = ContactUs::find($id);

        return view("dashboard.appContact.show", compact("GeneralWebmasterSections", "Permissions", "ContactUs"));
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
                //find ContactUss

                $ContactUss = ContactUs::where('name', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('title', 'like', '%' . $request->q . '%')
                    ->orwhere('description', 'like', '%' . $request->q . '%')
                    ->orwhere('mobile', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                //List of all ContactUss
                $ContactUss = ContactUs::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($request->q != "") {
              //find ContactUss

             $ContactUss = ContactUs::where('name', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('title', 'like', '%' . $request->q . '%')
                    ->orwhere('description', 'like', '%' . $request->q . '%')
                    ->orwhere('mobile', '=', $request->q)
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
               //List of all ContactUss
               $ContactUss = ContactUs::all()->orderby('id',
               'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }
      
        $search_word = $request->q;

        return view("dashboard.appContact.list",
            compact("ContactUss", "GeneralWebmasterSections", "search_word"));
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

        return view("dashboard.appContact.create", compact("GeneralWebmasterSections", "Permissions"));
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


        $ContactUss = new ContactUs;
        $ContactUss->name = $request->name;
        $ContactUss->mobile = $request->mobile;
        $ContactUss->title = $request->title;
        $ContactUss->description = $request->description;
        $ContactUss->save();

        return redirect()->action('Dashboard\AppContactController@index')->with('doneMessage', __('backend.addDone'));
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
            $ContactUs = ContactUs::find($id);
        } else {
            $ContactUs = ContactUs::find($id);
        }
        if (!empty($ContactUs)) {
            return view("dashboard.appContact.edit", compact("ContactUs", "Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\AppContactController@index');
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
        $ContactUs = ContactUs::find($id);
        if (!empty($ContactUs)) {


            $this->validate($request, [

            ]);
            
            if ($request->name != "") {
                $ContactUs->name = $request->name;
            }
            
            if ($request->mobile != "") {
                $ContactUs->mobile = $request->mobile;
            }
            
            if ($request->title != "") {
                $ContactUs->title = $request->title;
            }
            
            
            if ($request->description != "") {
                $ContactUs->description = $request->description;
            }
            

            $ContactUs->save();
            return redirect()->action('Dashboard\AppContactController@edit', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\AppContactController@index');
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
            $ContactUs = ContactUs::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $ContactUs = ContactUs::find($id);
        }
        if (!empty($ContactUs) && $id != 1) {

            $ContactUs->delete();
            return redirect()->action('Dashboard\AppContactController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\AppContactController@index');
        }
    }


  
}
