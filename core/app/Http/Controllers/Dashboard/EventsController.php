<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests;
use App\Models\WebmasterSection;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
        }
        $DefaultDate = date('Y-m-d');
        $EStatus = "";

        return view("dashboard.events.list", compact("GeneralWebmasterSections", "Events", "DefaultDate", "EStatus"));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
        }
        $DefaultDate = date('Y-m-d');
        $EStatus = "new";

        return view("dashboard.events.list", compact("GeneralWebmasterSections", "Events", "DefaultDate", "EStatus"));
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
            'type' => 'required',
            'title' => 'required'
        ]);

        $Event = new Event;
        $Event->user_id = Auth::user()->id;
        $Event->created_by = Auth::user()->id;
        $Event->type = $request->type;
        $Event->title = $request->title;
        $Event->details = $request->details;
        if ($request->type == 3) {
            // Task
            $Event->start_date = Helper::dateForDB($request->date_start);
            $Event->end_date = Helper::dateForDB($request->date_end);
        } elseif ($request->type == 2) {
            // Event
            $Event->start_date = Helper::dateForDB($request->time_start, 1);
            $Event->end_date = Helper::dateForDB($request->time_end, 1);
        } elseif ($request->type == 1) {
            // Meeting
            $Event->start_date = Helper::dateForDB($request->date_at, 1);
            $Event->end_date = Helper::dateForDB($request->date_at, 1);
        } else {
            // Note
            $Event->start_date = Helper::dateForDB($request->date);
            $Event->end_date = Helper::dateForDB($request->date);
        }
        $Event->save();

        return redirect()->action('Dashboard\EventsController@index')->with('doneMessage', __('backend.addDone'));
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

        //List of Events
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->orderby('start_date', 'asc')->get();
            $EditEvent = Event::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Events = Event::orderby('start_date', 'asc')->get();
            $EditEvent = Event::find($id);
        }

        if (!empty($EditEvent)) {
            $DefaultDate = $EditEvent->start_date;
            $EStatus = "edit";
            return view("dashboard.events.list",
                compact("GeneralWebmasterSections", "Events", "EditEvent", "DefaultDate", "EStatus"));
        } else {
            return redirect()->action('Dashboard\EventsController@index');
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
        $Event = Event::find($id);
        if (!empty($Event)) {

            $this->validate($request, [
                'type' => 'required',
                'title' => 'required'
            ]);

            $Event->type = $request->type;
            $Event->title = $request->title;
            $Event->details = $request->details;
            if ($request->type == 3) {
                // Task
                $Event->start_date = Helper::dateForDB($request->date_start);
                $Event->end_date = Helper::dateForDB($request->date_end);
            } elseif ($request->type == 2) {
                // Event
                $Event->start_date = Helper::dateForDB($request->time_start, 1);
                $Event->end_date = Helper::dateForDB($request->time_end, 1);
            } elseif ($request->type == 1) {
                // Meeting
                $Event->start_date = Helper::dateForDB($request->date_at, 1);
                $Event->end_date = Helper::dateForDB($request->date_at, 1);
            } else {
                // Note
                $Event->start_date = Helper::dateForDB($request->date);
                $Event->end_date = Helper::dateForDB($request->date);
            }
            $Event->updated_by = Auth::user()->id;
            $Event->save();
            return redirect()->action('Dashboard\EventsController@index', $id)->with('doneMessage', __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\EventsController@index');
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
            $Event = Event::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $Event = Event::find($id);
        }
        if (!empty($Event)) {
            $Event->delete();
            return redirect()->action('Dashboard\EventsController@index')->with('doneMessage', __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\EventsController@index');
        }
    }


    /**
     * Update all resources in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAll()
    {
        //
        Event::where('user_id', "=", Auth::user()->id)->delete();
        return redirect()->action('Dashboard\EventsController@index')->with('doneMessage', __('backend.saveDone'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function extend(Request $request, $id)
    {
        //
        $Event = Event::find($id);
        if (!empty($Event)) {
            if ($Event->type == 0) {
                $Event->type = 3;
            }
            if ($request->started_on != "") {
                $Event->start_date = date("Y-m-d H:i:s", strtotime($request->started_on));
            }
            if ($request->ended_on != "") {
                $Event->end_date = date("Y-m-d", strtotime($request->ended_on));
            }
            $Event->updated_by = Auth::user()->id;
            $Event->save();
        }
    }

}
