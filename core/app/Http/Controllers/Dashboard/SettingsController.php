<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Setting;
use App\Models\WebmasterSection;
use Auth;
use File;
use Illuminate\Http\Request;
use Redirect;
use Helper;

class SettingsController extends Controller
{
    // Define Default Settings ID
    private $uploadPath = "uploads/settings/";

    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0 && Auth::user()->permissions != 1) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    public function edit()
    {
        //

        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $id = 1;
        $Setting = Setting::find($id);
        if (!empty($Setting)) {
            return view("dashboard.settings.settings", compact("Setting", "GeneralWebmasterSections"));

        } else {
            return redirect()->route('adminHome');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id = 1 for default settings
     * @return \Illuminate\Http\Response
     */
    public function updateSiteInfo(Request $request)
    {
        //
        $id = 1;
        $Setting = Setting::find($id);
        if (!empty($Setting)) {

            $this->validate($request, [
                'style_logo_en' => 'mimes:png,jpeg,jpg,gif,svg',
                'style_logo_ar' => 'mimes:png,jpeg,jpg,gif,svg',
                'style_fav' => 'mimes:png,jpeg,jpg,gif,svg',
                'style_apple' => 'mimes:png,jpeg,jpg,gif,svg',
                'style_bg_image' => 'mimes:png,jpeg,jpg,gif,svg',
                'style_footer_bg' => 'mimes:png,jpeg,jpg,gif,svg'
            ]);
            foreach (Helper::languagesList() as $ActiveLanguage) {

                // Start of Upload Files
                $formFileName = "style_logo_" . $ActiveLanguage->code;
                $fileFinalName = "";
                if ($request->$formFileName != "") {
                    $this->validate($request, [
                        $formFileName => 'mimes:png,jpeg,jpg,gif,svg'
                    ]);

                    $fileFinalName = time() . rand(1111,
                            9999) . '.' . $request->file($formFileName)->getClientOriginalExtension();
                    $path = $this->uploadPath;
                    $request->file($formFileName)->move($path, $fileFinalName);
                }

                //save file name
                if ($fileFinalName != "") {
                    // Delete a banner file
                    if ($Setting->{"style_logo_" . $ActiveLanguage->code} != "") {
                        File::delete($this->uploadPath . $Setting->{"style_logo_" . $ActiveLanguage->code});
                    }

                    $Setting->{"style_logo_" . $ActiveLanguage->code} = $fileFinalName;
                }

                $Setting->{"site_title_" . $ActiveLanguage->code} = $request->{"site_title_" . $ActiveLanguage->code};
                $Setting->{"site_desc_" . $ActiveLanguage->code} = $request->{"site_desc_" . $ActiveLanguage->code};
                $Setting->{"site_keywords_" . $ActiveLanguage->code} = $request->{"site_keywords_" . $ActiveLanguage->code};
                $Setting->{"contact_t1_" . $ActiveLanguage->code} = $request->{"contact_t1_" . $ActiveLanguage->code};
                $Setting->{"contact_t7_" . $ActiveLanguage->code} = $request->{"contact_t7_" . $ActiveLanguage->code};
            }
            $Setting->site_webmails = $request->site_webmails;
            $Setting->notify_messages_status = $request->notify_messages_status;
            $Setting->notify_comments_status = $request->notify_comments_status;
            $Setting->notify_orders_status = $request->notify_orders_status;
            $Setting->notify_table_status = $request->notify_table_status;
            $Setting->notify_private_status = $request->notify_private_status;
            $Setting->site_url = $request->site_url;


            $formFileName2 = "style_fav";
            $fileFinalName2 = "";
            if ($request->$formFileName2 != "") {
                // Delete a style_fav photo
                if ($Setting->style_fav != "") {
                    File::delete($this->uploadPath . $Setting->style_fav);
                }

                $fileFinalName2 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName2)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName2)->move($path, $fileFinalName2);
            }


            $formFileName3 = "style_apple";
            $fileFinalName3 = "";
            if ($request->$formFileName3 != "") {
                // Delete a style_apple photo
                if ($Setting->style_apple != "") {
                    File::delete($this->uploadPath . $Setting->style_apple);
                }

                $fileFinalName3 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName3)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName3)->move($path, $fileFinalName3);
            }


            $formFileName4 = "style_bg_image";
            $fileFinalName4 = "";
            if ($request->$formFileName4 != "") {
                // Delete a style_bg_image photo
                if ($Setting->style_bg_image != "") {
                    File::delete($this->uploadPath . $Setting->style_bg_image);
                }

                $fileFinalName4 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName4)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName4)->move($path, $fileFinalName4);
            }


            $formFileName5 = "style_footer_bg";
            $fileFinalName5 = "";
            if ($request->$formFileName5 != "") {
                // Delete a style_footer_bg photo
                if ($Setting->style_footer_bg != "") {
                    File::delete($this->uploadPath . $Setting->style_footer_bg);
                }

                $fileFinalName5 = time() . rand(1111,
                        9999) . '.' . $request->file($formFileName5)->getClientOriginalExtension();
                $path = $this->uploadPath;
                $request->file($formFileName5)->move($path, $fileFinalName5);
            }

            // End of Upload Files
            if ($fileFinalName2 != "") {
                $Setting->style_fav = $fileFinalName2;
            }
            if ($fileFinalName3 != "") {
                $Setting->style_apple = $fileFinalName3;
            }

            $Setting->style_color1 = $request->style_color1;
            $Setting->style_color2 = $request->style_color2;
            $Setting->style_type = $request->style_type;
            $Setting->style_bg_type = $request->style_bg_type;
            $Setting->style_bg_pattern = $request->style_bg_pattern;
            $Setting->style_bg_color = $request->style_bg_color;
            if ($fileFinalName4 != "") {
                $Setting->style_bg_image = $fileFinalName4;
            }
            $Setting->style_subscribe = $request->style_subscribe;
            $Setting->style_footer = $request->style_footer;
            $Setting->style_header = $request->style_header;
            if ($request->photo_delete == 1) {
                // Delete style_footer_bg
                if ($Setting->style_footer_bg != "") {
                    File::delete($this->uploadPath . $Setting->style_footer_bg);
                }

                $Setting->style_footer_bg = "";
            }

            if ($fileFinalName5 != "") {
                $Setting->style_footer_bg = $fileFinalName5;
            }
            $Setting->style_preload = $request->style_preload;
            $Setting->css = $request->css_code;

            $Setting->social_link1 = $request->social_link1;
            $Setting->social_link2 = $request->social_link2;
            $Setting->social_link3 = $request->social_link3;
            $Setting->social_link4 = $request->social_link4;
            $Setting->social_link5 = $request->social_link5;
            $Setting->social_link6 = $request->social_link6;
            $Setting->social_link7 = $request->social_link7;
            $Setting->social_link8 = $request->social_link8;
            $Setting->social_link9 = $request->social_link9;
            $Setting->social_link10 = $request->social_link10;

            $Setting->contact_t3 = $request->contact_t3;
            $Setting->contact_t4 = $request->contact_t4;
            $Setting->contact_t5 = $request->contact_t5;
            $Setting->contact_t6 = $request->contact_t6;

            $Setting->site_status = $request->site_status;
            $Setting->close_msg = $request->close_msg;


            $Setting->updated_by = Auth::user()->id;

            $Setting->save();
            return redirect()->action('Dashboard\SettingsController@edit')
                ->with('doneMessage', __('backend.saveDone'))
                ->with('active_tab', $request->active_tab);
        } else {
            return redirect()->route('adminHome');
        }
    }

}
