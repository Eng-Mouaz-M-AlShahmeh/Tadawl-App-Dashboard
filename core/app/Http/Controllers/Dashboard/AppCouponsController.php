<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Permissions;
use App\Models\User;

use App\Models\Coupon;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Config;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class AppCouponsController extends Controller
{

  
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
            
            
            $Coupons = Coupon::all();
            
            
        } else {
            $Users = User::orderby('id', 'asc')->paginate(env('BACKEND_PAGINATION'));
            $Permissions = Permissions::orderby('id', 'asc')->get();
            
            
            
            $Coupons = Coupon::all();
        }
        
        
        return view("dashboard.appCoupons.list", compact("Users", "Permissions", "Coupons", "search_word", "GeneralWebmasterSections"));
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
        
        $Coupon = Coupon::find($id);

        return view("dashboard.appCoupons.show", compact("GeneralWebmasterSections", "Permissions", "Coupon"));
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

                $Coupons = Coupon::where('code', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('num_of_use', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                $Coupons = Coupon::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        } else {
            if ($request->q != "") {

                 $Coupons = Coupon::where('code', 'like',
                    '%' . $request->q . '%')
                    ->orwhere('num_of_use', 'like', '%' . $request->q . '%')
                    ->orderby('id', 'desc')->paginate(env('BACKEND_PAGINATION'));
            } else {
                $Coupons = Coupon::all()->orderby('id',
                    'desc')->paginate(env('BACKEND_PAGINATION'));
            }
        }
      
        $search_word = $request->q;

        return view("dashboard.appCoupons.list",
            compact("Coupons", "GeneralWebmasterSections", "search_word"));
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

        return view("dashboard.appCoupons.create", compact("GeneralWebmasterSections", "Permissions"));
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


        $Coupon = new Coupon;
        $Coupon->code = $request->code;
        $Coupon->start_at = $request->start_at;
        $Coupon->end_at = $request->end_at;
        $Coupon->discount_ammount = $request->discount_ammount;
        $Coupon->discount_ratio = $request->discount_ratio;
        $Coupon->num_of_use = $request->num_of_use;
        $Coupon->state = 1;
        $Coupon->save();

        return redirect()->action('Dashboard\AppCouponsController@index')->with('doneMessage', __('backend.addDone'));
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
           $Coupon = Coupon::find($id);
        } else {
            $Coupon = Coupon::find($id);
        }
        if (!empty($Coupon)) {
            return view("dashboard.appCoupons.edit", compact("Coupon", "Permissions", "GeneralWebmasterSections"));
        } else {
            return redirect()->action('Dashboard\AppCouponsController@index');
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
        $Coupon = Coupon::find($id);
        if (!empty($Coupon)) {


            $this->validate($request, [
                //'image' => 'mimes:png,jpeg,jpg,gif,svg',
                //'username' => 'required',
                //'phone' => 'required|unique:user',
                //'password' => 'required|min:8|same:rePassword',
                //'rePassword' => 'required|min:8|',
                //'about' => 'required',

            ]);

            if ($request->code != $Coupon->code) {
                $this->validate($request, [
                  //  'email' => 'required|email',
                ]);
            }
          
            
            if ($request->start_at != "") {
                $Coupon->start_at = $request->start_at;
            }
            
            if ($request->end_at != "") {
                $Coupon->end_at = $request->end_at;
            }
            
            if ($request->discount_ammount != "") {
                $Coupon->discount_ammount = $request->discount_ammount;
            }
            
            
            if ($request->discount_ratio != "") {
                $Coupon->discount_ratio = $request->discount_ratio;
            }
            
            if ($request->num_of_use != "") {
                $Coupon->num_of_use = $request->num_of_use;
            }
            
             if ($request->state != "") {
                $Coupon->state = $request->state;
            }
            

            $Coupon->save();
            return redirect()->action('Dashboard\AppCouponsController@edit', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\AppCouponsController@index');
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
            $Coupon = Coupon::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Coupon = Coupon::find($id);
        }
        if (!empty($Coupon) && $id != 1) {

            $Coupon->delete();
            return redirect()->action('Dashboard\AppCouponsController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\AppCouponsController@index');
        }
    }


  
}
