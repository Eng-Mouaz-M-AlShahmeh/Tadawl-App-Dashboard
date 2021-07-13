<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Menu;
use App\Models\WebmasterSection;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class MenusController extends Controller
{

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
    public function index($ParentMenuId = 0)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        if ($ParentMenuId > 0) {
            $EditedMenu = Menu::find($ParentMenuId);
            $Menus = Menu::where('father_id', $ParentMenuId)->orderby('row_no',
                'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $MenusCount = Menu::where('father_id', '0')->count();
            if ($MenusCount > 0) {
                $Menusfirst = Menu::orderby('row_no', 'asc')->first();
                $Menus = Menu::where('father_id', $Menusfirst->id)->orderby('row_no',
                    'asc')->paginate(env('BACKEND_PAGINATION'));
                $EditedMenu = Menu::find($Menusfirst->id);
            } else {
                $Menus = Menu::where('father_id', '0')->orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
                $EditedMenu = "";
            }
        }
        //Parent Menus
        $ParentMenus = Menu::where('father_id', '0')->orderby('row_no', 'asc')->get();

        return view("dashboard.menus.list", compact("Menus", "GeneralWebmasterSections", "ParentMenus", "EditedMenu"));
    }

    /**
     * Show the form for creating a new resource.
     * @param int $ParentMenuId
     * @return \Illuminate\Http\Response
     */
    public function create($ParentMenuId = 0)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Father Menus
        $FatherMenus = Menu::where('father_id', $ParentMenuId)->where('type', 0)->orderby('row_no', 'asc')->get();

        return view("dashboard.menus.create",
            compact("GeneralWebmasterSections", "ParentMenuId", "FatherMenus"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $ParentMenuId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $ParentMenuId = 0)
    {
        //
        $next_nor_no = Menu::where('father_id', $ParentMenuId)->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        $Menu = new Menu;
        $Menu->row_no = $next_nor_no;
        $father = $ParentMenuId;
        if ($request->father_id > 0) {
            $father = $request->father_id;
        }
        $Menu->father_id = $father;
        foreach (Helper::languagesList() as $ActiveLanguage) {
            if ($ActiveLanguage->box_status) {
                $Menu->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
            }
        }
        $Menu->type = $request->type;
        $Menu->link = $request->link;
        $Menu->cat_id = $request->cat_id;
        $Menu->status = 1;
        $Menu->created_by = Auth::user()->id;
        $Menu->save();

        return redirect()->action('Dashboard\MenusController@edit', [$Menu->id,$request->ParentMenuId])->with('ParentMenuId',
            $ParentMenuId)->with('doneMessage', __('backend.addDone'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeMenu(Request $request)
    {
        //
        $next_nor_no = Menu::where('father_id', "0")->max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }

        $Menu = new Menu;
        $Menu->row_no = $next_nor_no;
        $Menu->father_id = 0;
        foreach (Helper::languagesList() as $ActiveLanguage) {
            if ($ActiveLanguage->box_status) {
                $Menu->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
            }
        }
        $Menu->created_by = Auth::user()->id;
        $Menu->status = 1;
        $Menu->save();

        return redirect()->action('Dashboard\MenusController@index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param int $ParentMenuId
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $ParentMenuId)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //Father Menus
        $FatherMenus = Menu::where('father_id', $ParentMenuId)->where('type', 0)->where('id', "!=", $id)->orderby('row_no', 'asc')->get();

        $Menus = Menu::find($id);
        if (!empty($Menus)) {
            return view("dashboard.menus.edit",
                compact("Menus", "GeneralWebmasterSections", "ParentMenuId", "FatherMenus"));
        } else {
            return redirect()->action('Dashboard\MenusController@index');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editMenu($id)
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $Menus = Menu::find($id);
        if (!empty($Menus)) {
            return redirect()->action('Dashboard\MenusController@index', $id)->with('EditMenu', "Yes");
        } else {
            return redirect()->action('Dashboard\MenusController@index');
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
        $Menu = Menu::find($id);
        if (!empty($Menu)) {

            $Menu->father_id = $request->father_id;
            foreach (Helper::languagesList() as $ActiveLanguage) {
                if ($ActiveLanguage->box_status) {
                    $Menu->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
                }
            }
            $Menu->type = $request->type;
            $Menu->link = $request->link;
            $Menu->cat_id = $request->cat_id;
            $Menu->status = $request->status;
            $Menu->updated_by = Auth::user()->id;
            $Menu->save();
            return redirect()->action('Dashboard\MenusController@edit', [$Menu->id,$request->ParentMenuId])->with('doneMessage', __('backend.addDone'));
        } else {
            return redirect()->action('Dashboard\MenusController@index');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateMenu(Request $request, $id)
    {
        //
        $Menu = Menu::find($id);
        if (!empty($Menu)) {
            foreach (Helper::languagesList() as $ActiveLanguage) {
                if ($ActiveLanguage->box_status) {
                    $Menu->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
                }
            }
            $Menu->updated_by = Auth::user()->id;
            $Menu->save();
            return redirect()->action('Dashboard\MenusController@index',
                ["id" => $id, "ParentMenuId" => $request->ParentMenuId])->with('doneMessage2',
                __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\MenusController@index');
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
        $Menu = Menu::find($id);
        if (!empty($Menu)) {
            $Menu->delete();
            return redirect()->action('Dashboard\MenusController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\MenusController@index');
        }
    }


    public function destroyMenu($id)
    {
        //
        $Menu = Menu::find($id);
        if (!empty($Menu)) {
            $subMenus = Menu::where('father_id', $Menu->id)->get();
            foreach ($subMenus as $subMenu) {
                Menu::where('father_id', $subMenu->id)->delete();
            }
            Menu::where('father_id', $Menu->id)->delete();
            $Menu->delete();
            return redirect()->action('Dashboard\MenusController@index')->with('doneMessage2', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\MenusController@index');
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
                $Menu = Menu::find($rowId);
                if (!empty($Menu)) {
                    $row_no_val = "row_no_" . $rowId;
                    $Menu->row_no = $request->$row_no_val;
                    $Menu->save();
                }
            }

        } else {
            if ($request->ids != "") {
                if ($request->action == "activate") {
                    Menu::wherein('id', $request->ids)
                        ->update(['status' => 1]);

                } elseif ($request->action == "block") {
                    Menu::wherein('id', $request->ids)
                        ->update(['status' => 0]);

                } elseif ($request->action == "delete") {

                    Menu::wherein('father_id', $request->ids)->delete();
                    Menu::wherein('id', $request->ids)
                        ->delete();

                }
            }
        }
        return redirect()->action('Dashboard\MenusController@index', $request->ParentMenuId)->with('doneMessage2',
            __('backend.saveDone'));
    }

}
