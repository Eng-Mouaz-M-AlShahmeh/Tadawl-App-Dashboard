<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AttachFile;
use App\Models\Comment;
use App\Http\Requests;
use App\Models\Map;
use App\Models\Permissions;
use App\Models\Photo;
use App\Models\RelatedTopic;
use App\Models\TopicCategory;
use App\Models\TopicField;
use App\Models\WebmasterSection;
use App\Models\WebmasterSectionField;
use App\Models\Menu;
use Auth;
use File;
use Helper;
use Illuminate\Http\Request;
use Redirect;

class WebmasterSectionsController extends Controller
{
    private $uploadPath = "uploads/topics/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0) {
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
            $WebmasterSections = WebmasterSection::where('created_by', '=', Auth::user()->id)->orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        } else {
            $WebmasterSections = WebmasterSection::orderby('row_no', 'asc')->paginate(env('BACKEND_PAGINATION'));
        }
        return view("dashboard.webmaster.sections.list", compact("WebmasterSections", "GeneralWebmasterSections"));
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
        return view("dashboard.webmaster.sections.create", compact("GeneralWebmasterSections"));
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
        $next_nor_no = WebmasterSection::max('row_no');
        if ($next_nor_no < 1) {
            $next_nor_no = 1;
        } else {
            $next_nor_no++;
        }
        $WebmasterSection = new WebmasterSection;
        $WebmasterSection->row_no = $next_nor_no;
        foreach (Helper::languagesList() as $ActiveLanguage) {
            $WebmasterSection->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
            $WebmasterSection->{"seo_url_slug_" . $ActiveLanguage->code} = Helper::URLSlug($request->{"title_" . $ActiveLanguage->code}, "section", 0);
        }
        $WebmasterSection->type = $request->type;
        $WebmasterSection->sections_status = $request->sections_status;
        $WebmasterSection->comments_status = $request->comments_status;
        $WebmasterSection->title_status = $request->title_status;
        $WebmasterSection->photo_status = $request->photo_status;
        $WebmasterSection->case_status = $request->case_status;
        $WebmasterSection->visits_status = $request->visits_status;
        $WebmasterSection->date_status = $request->date_status;
        $WebmasterSection->expire_date_status = $request->expire_date_status;
        $WebmasterSection->longtext_status = $request->longtext_status;
        $WebmasterSection->editor_status = $request->editor_status;
        $WebmasterSection->attach_file_status = $request->attach_file_status;
        $WebmasterSection->extra_attach_file_status = $request->extra_attach_file_status;
        $WebmasterSection->multi_images_status = $request->multi_images_status;
        $WebmasterSection->maps_status = $request->maps_status;
        $WebmasterSection->order_status = $request->order_status;
        $WebmasterSection->section_icon_status = $request->section_icon_status;
        $WebmasterSection->icon_status = $request->icon_status;
        $WebmasterSection->related_status = $request->related_status;
        $WebmasterSection->status = 1;
        $WebmasterSection->created_by = Auth::user()->id;
        $WebmasterSection->save();

        $Permissions = Permissions::find(Auth::user()->permissionsGroup->id);
        if (!empty($Permissions)) {
            $Permissions->data_sections = $Permissions->data_sections . "," . $WebmasterSection->id;
            $Permissions->save();
        }
        if (Auth::user()->permissionsGroup->id != 1) {
            $Permissions = Permissions::find(1);
            if (!empty($Permissions)) {
                $Permissions->data_sections = $Permissions->data_sections . "," . $WebmasterSection->id;
                $Permissions->save();
            }
        }

        return redirect()->action('Dashboard\WebmasterSectionsController@index')->with('doneMessage', __('backend.addDone'));
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
            $WebmasterSections = WebmasterSection::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterSections = WebmasterSection::find($id);
        }
        if (!empty($WebmasterSections)) {
            $PermissionsList = Permissions::orderby('id', 'asc')->get();
            return view("dashboard.webmaster.sections.edit", compact("WebmasterSections", "GeneralWebmasterSections", "PermissionsList"));
        } else {
            return redirect()->action('Dashboard\WebmasterSectionsController@index');
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
        $WebmasterSection = WebmasterSection::find($id);
        if (!empty($WebmasterSection)) {
            foreach (Helper::languagesList() as $ActiveLanguage) {
                $WebmasterSection->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
            }
            $WebmasterSection->type = $request->type;
            $WebmasterSection->sections_status = $request->sections_status;
            $WebmasterSection->comments_status = $request->comments_status;
            $WebmasterSection->title_status = $request->title_status;
            $WebmasterSection->photo_status = $request->photo_status;
            $WebmasterSection->case_status = $request->case_status;
            $WebmasterSection->visits_status = $request->visits_status;
            $WebmasterSection->date_status = $request->date_status;
            $WebmasterSection->expire_date_status = $request->expire_date_status;
            $WebmasterSection->longtext_status = $request->longtext_status;
            $WebmasterSection->editor_status = $request->editor_status;
            $WebmasterSection->attach_file_status = $request->attach_file_status;
            $WebmasterSection->extra_attach_file_status = $request->extra_attach_file_status;
            $WebmasterSection->multi_images_status = $request->multi_images_status;
            $WebmasterSection->maps_status = $request->maps_status;
            $WebmasterSection->order_status = $request->order_status;
            $WebmasterSection->section_icon_status = $request->section_icon_status;
            $WebmasterSection->icon_status = $request->icon_status;
            $WebmasterSection->related_status = $request->related_status;
            $WebmasterSection->status = $request->status;
            $WebmasterSection->updated_by = Auth::user()->id;
            $WebmasterSection->save();
            return redirect()->action('Dashboard\WebmasterSectionsController@edit', $id)->with('doneMessage',
                __('backend.saveDone'));
        } else {
            return redirect()->action('Dashboard\WebmasterSectionsController@index');
        }
    }

    public function seo(Request $request, $id)
    {
        //
        $WebmasterSection = WebmasterSection::find($id);
        if (!empty($WebmasterSection)) {
            foreach (Helper::languagesList() as $ActiveLanguage) {
                $WebmasterSection->{"seo_title_" . $ActiveLanguage->code} = $request->{"seo_title_" . $ActiveLanguage->code};
                $WebmasterSection->{"seo_description_" . $ActiveLanguage->code} = $request->{"seo_description_" . $ActiveLanguage->code};
                $WebmasterSection->{"seo_keywords_" . $ActiveLanguage->code} = $request->{"seo_keywords_" . $ActiveLanguage->code};
                $WebmasterSection->{"seo_url_slug_" . $ActiveLanguage->code} = Helper::URLSlug($request->{"seo_url_slug_" . $ActiveLanguage->code}, "section", $id);
            }
            $WebmasterSection->updated_by = Auth::user()->id;
            $WebmasterSection->save();
            return redirect()->action('Dashboard\WebmasterSectionsController@edit', $id)->with('doneMessage',
                __('backend.saveDone'))->with('activeTab', 'seo');
        } else {
            return redirect()->action('SectionsController@index');
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
            $WebmasterSection = WebmasterSection::where('created_by', '=', Auth::user()->id)->find($id);
        } else {
            $WebmasterSection = WebmasterSection::find($id);
        }
        if (!empty($WebmasterSection)) {

            if (count($WebmasterSection->topics) > 0) {
                foreach ($WebmasterSection->topics as $Topic) {
                    //delete topics
                    // Delete a Topic photo
                    if ($Topic->photo_file != "") {
                        File::delete($this->uploadPath . $Topic->photo_file);
                    }
                    if ($Topic->attach_file != "") {
                        File::delete($this->uploadPath . $Topic->attach_file);
                    }
                    if ($Topic->audio_file != "") {
                        File::delete($this->uploadPath . $Topic->audio_file);
                    }
                    if ($Topic->video_type == 0 && $Topic->video_file != "") {
                        File::delete($this->uploadPath . $Topic->video_file);
                    }
                    //delete additional fields
                    TopicField::where('topic_id', $Topic->id)->delete();
                    //delete Related Topics
                    RelatedTopic::where('topic_id', $Topic->id)->delete();
                    // Remove categories
                    TopicCategory::where('topic_id', $Topic->id)->delete();
                    // Remove comments
                    Comment::where('topic_id', $Topic->id)->delete();
                    // Remove maps
                    Map::where('topic_id', $Topic->id)->delete();
                    // Remove Photos
                    $PhotoFiles = Photo::where('topic_id', $Topic->id)->get();
                    if (count($PhotoFiles) > 0) {
                        foreach ($PhotoFiles as $PhotoFile) {
                            if ($PhotoFile->file != "") {
                                File::delete($this->uploadPath . $PhotoFile->file);
                            }
                        }
                    }
                    Photo::where('topic_id', $Topic->id)->delete();
                    // Remove Attach Files
                    $AttachFiles = AttachFile::where('topic_id', $Topic->id)->get();
                    if (count($AttachFiles) > 0) {
                        foreach ($AttachFiles as $AttachFile) {
                            if ($AttachFile->file != "") {
                                File::delete($this->uploadPath . $AttachFile->file);
                            }
                        }
                    }
                    AttachFile::where('topic_id', $Topic->id)->delete();

                    //Remove Topic
                    $Topic->delete();
                }
            }
            //delete categories
            if (count($WebmasterSection->sections) > 0) {
                foreach ($WebmasterSection->sections as $Section) {
                    $Section->delete();
                }
            }
            //delete menus
            if (count($WebmasterSection->menus) > 0) {
                foreach ($WebmasterSection->menus as $Menu) {
                    $Menu->delete();
                }
            }
            Menu::where('cat_id', $id)->delete();
            //delete additional fields
            WebmasterSectionField::where('webmaster_id', $id)->delete();
            //delete section
            $WebmasterSection->delete();
            return redirect()->action('Dashboard\WebmasterSectionsController@index')->with('doneMessage',
                __('backend.deleteDone'));
        } else {
            return redirect()->action('Dashboard\WebmasterSectionsController@index');
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
                $WebmasterSection = WebmasterSection::find($rowId);
                if (!empty($WebmasterSection)) {
                    $row_no_val = "row_no_" . $rowId;
                    $WebmasterSection->row_no = $request->$row_no_val;
                    $WebmasterSection->save();
                }
            }
        } else {
            if ($request->ids != "") {
                if ($request->action == "activate") {
                    WebmasterSection::wherein('id', $request->ids)
                        ->update(['status' => 1]);

                } elseif ($request->action == "block") {
                    WebmasterSection::wherein('id', $request->ids)
                        ->update(['status' => 0]);

                } elseif ($request->action == "delete") {

                    $WebmasterSections = WebmasterSection::wherein('id', $request->ids)->get();
                    foreach ($WebmasterSections as $WebmasterSection) {

                        if (count($WebmasterSection->topics) > 0) {
                            foreach ($WebmasterSection->topics as $Topic) {
                                //delete topics
                                // Delete a Topic photo
                                if ($Topic->photo_file != "") {
                                    File::delete($this->uploadPath . $Topic->photo_file);
                                }
                                if ($Topic->attach_file != "") {
                                    File::delete($this->uploadPath . $Topic->attach_file);
                                }
                                if ($Topic->audio_file != "") {
                                    File::delete($this->uploadPath . $Topic->audio_file);
                                }
                                if ($Topic->video_type == 0 && $Topic->video_file != "") {
                                    File::delete($this->uploadPath . $Topic->video_file);
                                }
                                //delete additional fields
                                TopicField::where('topic_id', $Topic->id)->delete();
                                //delete Related Topics
                                RelatedTopic::where('topic_id', $Topic->id)->delete();
                                // Remove categories
                                TopicCategory::where('topic_id', $Topic->id)->delete();
                                // Remove comments
                                Comment::where('topic_id', $Topic->id)->delete();
                                // Remove maps
                                Map::where('topic_id', $Topic->id)->delete();
                                // Remove Photos
                                $PhotoFiles = Photo::where('topic_id', $Topic->id)->get();
                                if (count($PhotoFiles) > 0) {
                                    foreach ($PhotoFiles as $PhotoFile) {
                                        if ($PhotoFile->file != "") {
                                            File::delete($this->uploadPath . $PhotoFile->file);
                                        }
                                    }
                                }
                                Photo::where('topic_id', $Topic->id)->delete();
                                // Remove Attach Files
                                $AttachFiles = AttachFile::where('topic_id', $Topic->id)->get();
                                if (count($AttachFiles) > 0) {
                                    foreach ($AttachFiles as $AttachFile) {
                                        if ($AttachFile->file != "") {
                                            File::delete($this->uploadPath . $AttachFile->file);
                                        }
                                    }
                                }
                                AttachFile::where('topic_id', $Topic->id)->delete();

                                //Remove Topic
                                $Topic->delete();
                            }
                        }
                        //delete categories
                        if (count($WebmasterSection->sections) > 0) {
                            foreach ($WebmasterSection->sections as $Section) {
                                $Section->delete();
                            }
                        }
                        //delete menus
                        if (count($WebmasterSection->menus) > 0) {
                            foreach ($WebmasterSection->menus as $Menu) {
                                $Menu->delete();
                            }
                        }
                    }

                    Menu::wherein('cat_id', $request->ids)->delete();
                    //delete additional fields
                    WebmasterSectionField::wherein('webmaster_id', $request->ids)->delete();
                    //delete section
                    WebmasterSection::wherein('id', $request->ids)
                        ->delete();

                }
            }
        }
        return redirect()->action('Dashboard\WebmasterSectionsController@index')->with('doneMessage', __('backend.saveDone'));
    }



// Fields Functions

    /**
     * Show all Fields.
     *
     * @param int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function webmasterFields($webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsCreate($webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab',
                'fields')->with('fieldST', 'create');
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsStore(Request $request, $webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            //
            $this->validate($request, [
                'type' => 'required'
            ]);

            $next_nor_no = WebmasterSectionField::where('webmaster_id', '=', $webmasterId)->max('row_no');
            if ($next_nor_no < 1) {
                $next_nor_no = 1;
            } else {
                $next_nor_no++;
            }

            $WebmasterSectionField = new WebmasterSectionField;
            $WebmasterSectionField->webmaster_id = $webmasterId;
            $WebmasterSectionField->row_no = $next_nor_no;
            foreach (Helper::languagesList() as $ActiveLanguage) {
                if ($ActiveLanguage->box_status) {
                    $WebmasterSectionField->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
                    $WebmasterSectionField->{"details_" . $ActiveLanguage->code} = $request->{"details_" . $ActiveLanguage->code};
                }
            }
            $WebmasterSectionField->default_value = $request->default_value;
            $WebmasterSectionField->lang_code = $request->lang_code;
            $WebmasterSectionField->css_class = $request->css_class;
            $WebmasterSectionField->type = $request->type;
            $WebmasterSectionField->required = ($request->required) ? 1 : 0;
            $WebmasterSectionField->in_table = ($request->in_table) ? 1 : 0;
            $WebmasterSectionField->in_search = ($request->in_search) ? 1 : 0;
            $WebmasterSectionField->in_listing = ($request->in_listing) ? 1 : 0;
            $WebmasterSectionField->in_page = ($request->in_page) ? 1 : 0;
            $WebmasterSectionField->in_statics = ($request->in_statics) ? 1 : 0;
            $WebmasterSectionField->status = 1;
            $WebmasterSectionField->created_by = Auth::user()->id;

            $view_permission_groups_values = "";
            if (@$request->view_permission_groups != "") {
                foreach ($request->view_permission_groups as $key => $val) {
                    if ($val == 0) {
                        $view_permission_groups_values = "";
                        break;
                    } else {
                        $view_permission_groups_values = $val . "," . $view_permission_groups_values;
                    }
                }
                $view_permission_groups_values = substr($view_permission_groups_values, 0, -1);
            }
            if ($view_permission_groups_values == "") {
                $view_permission_groups_values = 0;
            }
            $WebmasterSectionField->view_permission_groups = $view_permission_groups_values;

            $add_permission_groups_values = "";
            if (@$request->add_permission_groups != "") {
                foreach ($request->add_permission_groups as $key => $val) {
                    if ($val == 0) {
                        $add_permission_groups_values = "";
                        break;
                    } else {
                        $add_permission_groups_values = $val . "," . $add_permission_groups_values;
                    }
                }
                $add_permission_groups_values = substr($add_permission_groups_values, 0, -1);
            }
            if ($add_permission_groups_values == "") {
                $add_permission_groups_values = 0;
            }
            $WebmasterSectionField->add_permission_groups = $add_permission_groups_values;

            $edit_permission_groups_values = "";
            if (@$request->edit_permission_groups != "") {
                foreach ($request->edit_permission_groups as $key => $val) {
                    if ($val == 0) {
                        $edit_permission_groups_values = "";
                        break;
                    } else {
                        $edit_permission_groups_values = $val . "," . $edit_permission_groups_values;
                    }
                }
                $edit_permission_groups_values = substr($edit_permission_groups_values, 0, -1);
            }
            if ($edit_permission_groups_values == "") {
                $edit_permission_groups_values = 0;
            }
            $WebmasterSectionField->edit_permission_groups = $edit_permission_groups_values;

            $WebmasterSectionField->save();

            return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                __('backend.saveDone'))->with('activeTab', 'fields');

        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $webmasterId
     * @param int $field_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsEdit($webmasterId, $field_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            $WebmasterSectionField = WebmasterSectionField::find($field_id);
            if (!empty($WebmasterSectionField)) {
                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab',
                    'fields')->with('fieldST', 'edit')->with('WebmasterSectionField', $WebmasterSectionField);
            } else {
                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $webmasterId
     * @param int $file_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsUpdate(Request $request, $webmasterId, $file_id)
    {

        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            //

            $WebmasterSectionField = WebmasterSectionField::find($file_id);
            if (!empty($WebmasterSectionField)) {
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($ActiveLanguage->box_status) {
                        $WebmasterSectionField->{"title_" . $ActiveLanguage->code} = $request->{"title_" . $ActiveLanguage->code};
                        $WebmasterSectionField->{"details_" . $ActiveLanguage->code} = $request->{"details_" . $ActiveLanguage->code};
                    }
                }
                $WebmasterSectionField->default_value = $request->default_value;
                $WebmasterSectionField->lang_code = $request->lang_code;
                $WebmasterSectionField->css_class = $request->css_class;
                $WebmasterSectionField->type = $request->type;
                $WebmasterSectionField->required = ($request->required) ? 1 : 0;
                $WebmasterSectionField->in_table = ($request->in_table) ? 1 : 0;
                $WebmasterSectionField->in_search = ($request->in_search) ? 1 : 0;
                $WebmasterSectionField->in_listing = ($request->in_listing) ? 1 : 0;
                $WebmasterSectionField->in_page = ($request->in_page) ? 1 : 0;
                $WebmasterSectionField->in_statics = ($request->in_statics) ? 1 : 0;
                $WebmasterSectionField->status = $request->status;
                $WebmasterSectionField->updated_by = Auth::user()->id;


                $view_permission_groups_values = "";
                if (@$request->view_permission_groups != "") {
                    foreach ($request->view_permission_groups as $key => $val) {
                        if ($val == 0) {
                            $view_permission_groups_values = "";
                            break;
                        } else {
                            $view_permission_groups_values = $val . "," . $view_permission_groups_values;
                        }
                    }
                    $view_permission_groups_values = substr($view_permission_groups_values, 0, -1);
                }
                if ($view_permission_groups_values == "") {
                    $view_permission_groups_values = 0;
                }
                $WebmasterSectionField->view_permission_groups = $view_permission_groups_values;

                $add_permission_groups_values = "";
                if (@$request->add_permission_groups != "") {
                    foreach ($request->add_permission_groups as $key => $val) {
                        if ($val == 0) {
                            $add_permission_groups_values = "";
                            break;
                        } else {
                            $add_permission_groups_values = $val . "," . $add_permission_groups_values;
                        }
                    }
                    $add_permission_groups_values = substr($add_permission_groups_values, 0, -1);
                }
                if ($add_permission_groups_values == "") {
                    $add_permission_groups_values = 0;
                }
                $WebmasterSectionField->add_permission_groups = $add_permission_groups_values;

                $edit_permission_groups_values = "";
                if (@$request->edit_permission_groups != "") {
                    foreach ($request->edit_permission_groups as $key => $val) {
                        if ($val == 0) {
                            $edit_permission_groups_values = "";
                            break;
                        } else {
                            $edit_permission_groups_values = $val . "," . $edit_permission_groups_values;
                        }
                    }
                    $edit_permission_groups_values = substr($edit_permission_groups_values, 0, -1);
                }
                if ($edit_permission_groups_values == "") {
                    $edit_permission_groups_values = 0;
                }
                $WebmasterSectionField->edit_permission_groups = $edit_permission_groups_values;

                $WebmasterSectionField->save();

                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                    __('backend.saveDone'))->with('activeTab', 'fields');
            } else {
                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $webmasterId
     * @param int $file_id
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsDestroy($webmasterId, $file_id)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            $WebmasterSectionField = WebmasterSectionField::find($file_id);
            if (!empty($WebmasterSectionField)) {
                $WebmasterSectionField->delete();
                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                    __('backend.deleteDone'))->with('activeTab', 'fields');
            } else {
                return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('activeTab', 'fields');
            }
        } else {
            return redirect()->route('NotFound');
        }
    }


    /**
     * Update all selected resources in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param buttonNames , array $ids[],$webmasterId
     * @return \Illuminate\Http\Response
     */
    public
    function fieldsUpdateAll(Request $request, $webmasterId)
    {
        $WebmasterSection = WebmasterSection::find($webmasterId);
        if (!empty($WebmasterSection)) {
            //
            if ($request->action == "order") {
                foreach ($request->row_ids as $rowId) {
                    $WebmasterSectionField = WebmasterSectionField::find($rowId);
                    if (!empty($WebmasterSectionField)) {
                        $row_no_val = "row_no_" . $rowId;
                        $WebmasterSectionField->row_no = $request->$row_no_val;
                        $WebmasterSectionField->save();
                    }
                }
            } else {
                if ($request->ids != "") {
                    if ($request->action == "activate") {
                        WebmasterSectionField::wherein('id', $request->ids)
                            ->update(['status' => 1]);

                    } elseif ($request->action == "block") {
                        WebmasterSectionField::wherein('id', $request->ids)
                            ->update(['status' => 0]);

                    } elseif ($request->action == "delete") {

                        WebmasterSectionField::wherein('id', $request->ids)
                            ->delete();

                    }
                }
            }
            return redirect()->action('Dashboard\WebmasterSectionsController@edit', [$webmasterId])->with('doneMessage',
                __('backend.saveDone'))->with('activeTab', 'fields');
        } else {
            return redirect()->route('NotFound');
        }
    }


}
