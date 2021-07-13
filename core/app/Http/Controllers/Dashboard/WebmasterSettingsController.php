<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AttachFile;
use App\Models\Banner;
use App\Models\ContactsGroup;
use App\Models\Country;
use App\Http\Requests;
use App\Models\Menu;
use App\Models\Permissions;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\Map;
use App\Models\Language;
use App\Models\WebmasterBanner;
use App\Models\WebmasterSection;
use App\Models\WebmasterSectionField;
use App\Models\WebmasterSetting;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use File;
use Helper;
use Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WebmasterSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Check Permissions
        if (@Auth::user()->permissions != 0) {
            return Redirect::to(route('NoPermission'))->send();
        }
    }

    public function edit()
    {
        //
        // General for all pages
        $GeneralWebmasterSections = WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
        // General END

        $ParentMenus = Menu::where('father_id', '0')->orderby('row_no', 'asc')->get();
        $WebmasterBanners = WebmasterBanner::orderby('row_no', 'asc')->get();
        $ContactsGroups = ContactsGroup::orderby('id', 'asc')->get();
        $PermissionsGroups = Permissions::orderby('id', 'asc')->get();
        $SitePages = Topic::where('webmaster_id', 1)->orderby('row_no', 'asc')->get();
        $Countries = Country::orderby('title_' . @Helper::currentLanguage()->code, 'asc')->get();
        $Languages = Language::orderby('id', 'asc')->get();

        $WebmasterSetting = WebmasterSetting::find(1);
        if (!empty($WebmasterSetting)) {
            return view("dashboard.webmaster.settings.home", compact("WebmasterSetting", "GeneralWebmasterSections", "ParentMenus", "WebmasterBanners", "ContactsGroups", "SitePages", "PermissionsGroups", "Countries", "Languages"));

        } else {
            return redirect()->route('adminHome');
        }
    }

    public function update(Request $request)
    {
        //
        $WebmasterSetting = WebmasterSetting::find(1);
        if (!empty($WebmasterSetting)) {
            $WebmasterSetting->seo_status = $request->seo_status;
            $WebmasterSetting->analytics_status = $request->analytics_status;
            $WebmasterSetting->banners_status = $request->banners_status;
            $WebmasterSetting->inbox_status = $request->inbox_status;
            $WebmasterSetting->calendar_status = $request->calendar_status;
            $WebmasterSetting->settings_status = $request->settings_status;
            $WebmasterSetting->newsletter_status = $request->newsletter_status;
            $WebmasterSetting->members_status = 0; //$request->orders_status;
            $WebmasterSetting->orders_status = 0; //$request->orders_status;
            $WebmasterSetting->shop_status = 0; //$request->shop_status;
            $WebmasterSetting->shop_settings_status = 0; //$request->shop_settings_status;
            $WebmasterSetting->default_currency_id = $request->default_currency_id;
            $WebmasterSetting->languages_by_default = $request->languages_by_default;
            $WebmasterSetting->header_menu_id = $request->header_menu_id;
            $WebmasterSetting->footer_menu_id = $request->footer_menu_id;
            $WebmasterSetting->home_banners_section_id = $request->home_banners_section_id;
            $WebmasterSetting->home_text_banners_section_id = $request->home_text_banners_section_id;
            $WebmasterSetting->side_banners_section_id = $request->side_banners_section_id;
            $WebmasterSetting->contact_page_id = $request->contact_page_id;
            $WebmasterSetting->newsletter_contacts_group = $request->newsletter_contacts_group;
            $WebmasterSetting->new_comments_status = $request->new_comments_status;
            $WebmasterSetting->links_status = $request->links_status;
            $WebmasterSetting->register_status = $request->register_status;
            $WebmasterSetting->permission_group = $request->permission_group;
            $WebmasterSetting->api_status = $request->api_status;
            $WebmasterSetting->api_key = $request->api_key;
            $WebmasterSetting->home_content1_section_id = $request->home_content1_section_id;
            $WebmasterSetting->home_content2_section_id = $request->home_content2_section_id;
            $WebmasterSetting->home_content3_section_id = $request->home_content3_section_id;
            $WebmasterSetting->home_contents_per_page = $request->home_contents_per_page;
            $WebmasterSetting->latest_news_section_id = $request->latest_news_section_id;

            $WebmasterSetting->mail_driver = $request->mail_driver;
            $WebmasterSetting->mail_host = $request->mail_host;
            $WebmasterSetting->mail_port = $request->mail_port;
            $WebmasterSetting->mail_username = $request->mail_username;
            $WebmasterSetting->mail_password = $request->mail_password;
            $WebmasterSetting->mail_encryption = $request->mail_encryption;
            $WebmasterSetting->mail_no_replay = $request->mail_no_replay;
            $WebmasterSetting->mail_title = $request->mail_title;
            $WebmasterSetting->mail_template = $request->mail_template;
            $WebmasterSetting->nocaptcha_status = $request->nocaptcha_status;
            $WebmasterSetting->nocaptcha_secret = $request->nocaptcha_secret;
            $WebmasterSetting->nocaptcha_sitekey = $request->nocaptcha_sitekey;
            $WebmasterSetting->google_tags_status = $request->google_tags_status;
            $WebmasterSetting->google_tags_id = $request->google_tags_id;
            $WebmasterSetting->google_analytics_code = $request->google_analytics_code;

            $WebmasterSetting->login_facebook_status = $request->login_facebook_status;
            $WebmasterSetting->login_facebook_client_id = $request->login_facebook_client_id;
            $WebmasterSetting->login_facebook_client_secret = $request->login_facebook_client_secret;
            $WebmasterSetting->login_twitter_status = $request->login_twitter_status;
            $WebmasterSetting->login_twitter_client_id = $request->login_twitter_client_id;
            $WebmasterSetting->login_twitter_client_secret = $request->login_twitter_client_secret;
            $WebmasterSetting->login_google_status = $request->login_google_status;
            $WebmasterSetting->login_google_client_id = $request->login_google_client_id;
            $WebmasterSetting->login_google_client_secret = $request->login_google_client_secret;
            $WebmasterSetting->login_linkedin_status = $request->login_linkedin_status;
            $WebmasterSetting->login_linkedin_client_id = $request->login_linkedin_client_id;
            $WebmasterSetting->login_linkedin_client_secret = $request->login_linkedin_client_secret;
            $WebmasterSetting->login_github_status = $request->login_github_status;
            $WebmasterSetting->login_github_client_id = $request->login_github_client_id;
            $WebmasterSetting->login_github_client_secret = $request->login_github_client_secret;
            $WebmasterSetting->login_bitbucket_status = $request->login_bitbucket_status;
            $WebmasterSetting->login_bitbucket_client_id = $request->login_bitbucket_client_id;
            $WebmasterSetting->login_bitbucket_client_secret = $request->login_bitbucket_client_secret;

            $WebmasterSetting->dashboard_link_status = $request->dashboard_link_status;
            $WebmasterSetting->timezone = $request->timezone;

            $WebmasterSetting->updated_by = Auth::user()->id;
            $WebmasterSetting->save();

            $OLD_BACKEND_PATH = env("BACKEND_PATH");
            // Update .env file
            $env_update = $this->changeEnv([
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_no_replay,
                'NOCAPTCHA_STATUS' => $request->nocaptcha_status,
                'NOCAPTCHA_SECRET' => $request->nocaptcha_secret,
                'NOCAPTCHA_SITEKEY' => $request->nocaptcha_sitekey,
                'DEFAULT_LANGUAGE' => $request->languages_by_default,
                'FRONTEND_PAGINATION' => $request->home_contents_per_page,
                'FACEBOOK_STATUS' => $request->login_facebook_status,
                'FACEBOOK_ID' => $request->login_facebook_client_id,
                'FACEBOOK_SECRET' => $request->login_facebook_client_secret,
                'TWITTER_STATUS' => $request->login_twitter_status,
                'TWITTER_ID' => $request->login_twitter_client_id,
                'TWITTER_SECRET' => $request->login_twitter_client_secret,
                'GOOGLE_STATUS' => $request->login_google_status,
                'GOOGLE_ID' => $request->login_google_client_id,
                'GOOGLE_SECRET' => $request->login_google_client_secret,
                'LINKEDIN_STATUS' => $request->login_linkedin_status,
                'LINKEDIN_ID' => $request->login_linkedin_client_id,
                'LINKEDIN_SECRET' => $request->login_linkedin_client_secret,
                'GITHUB_STATUS' => $request->login_github_status,
                'GITHUB_ID' => $request->login_github_client_id,
                'GITHUB_SECRET' => $request->login_github_client_secret,
                'BITBUCKET_STATUS' => $request->login_bitbucket_status,
                'BITBUCKET_ID' => $request->login_bitbucket_client_id,
                'BITBUCKET_SECRET' => $request->login_bitbucket_client_secret,
                'TIMEZONE' => $request->timezone,
                'GOOGLE_MAPS_KEY' => $request->google_maps_key,
                'FRONTEND_TOPICS_ORDER' => $request->front_topics_order,
                'BACKEND_PATH' => $request->backend_path,
                'GEOIP_STATUS' => $request->geoip_status,
                'GEOIP_SERVICE' => $request->geoip_service,
                'GEOIP_SERVICE_KEY' => $request->geoip_service_key,
                'FIRST_DAY_OF_WEEK' => $request->first_day_of_week,
                'DATE_FORMAT' => $request->date_format,
            ]);

            if ($OLD_BACKEND_PATH != $request->backend_path) {
                // redirect to new admin path
                return redirect()->to($request->backend_path . "/webmaster")->with('doneMessage', __('backend.saveDone'))->with('active_tab', $request->active_tab);
            }

            return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                ->with('doneMessage', __('backend.saveDone'))
                ->with('active_tab', $request->active_tab);
        } else {
            return redirect()->route('adminHome');
        }
    }

    public function language_store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'title' => 'required',
            'direction' => 'required',
            'fields' => 'required'
        ]);
        $left = "left";
        $right = "right";
        if ($request->direction == "rtl") {
            $left = "right";
            $right = "left";
        }
        $code = trim(strtolower(substr($request->code, 0, 2)));

        // Add new BD Columns
        $this->db_language_add($code);
        $success = false;
        $Language = Language::where("code", $code)->first();
        if (empty($Language)) {
            // Generate Lang files
            if ($code == "en") {
                $success = true;
            } else {
                $success = \File::copyDirectory(base_path("resources/lang/en"), base_path("resources/lang/$code"));
            }
            if ($success) {
                $Language = new Language;
                $Language->title = $request->title;
                $Language->code = $code;
                $Language->direction = $request->direction;
                $Language->icon = trim(strtolower($request->icon));
                $Language->box_status = ($request->fields) ? 1 : 0;
                $Language->left = $left;
                $Language->right = $right;
                $Language->status = 1;
                $Language->created_by = Auth::user()->id;
                $Language->save();

                return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                    ->with('doneMessage', __('backend.saveDone'))
                    ->with('active_tab', "languageSettingsTab");
            } else {
                return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                    ->with('errorMessage', __('backend.error'))
                    ->with('active_tab', "languageSettingsTab");
            }
        } else {
            return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                ->with('errorMessage', __('backend.languageExist'))
                ->with('active_tab', "languageSettingsTab");
        }
    }

    public function language_update(Request $request)
    {
        if (@Auth::user()->permissionsGroup->delete_status) {
            $Language = Language::find($request->id);
            if (!empty($Language)) {
                $this->validate($request, [
                    'title' => 'required',
                    'direction' => 'required',
                    'fields' => 'required'
                ]);
                $left = "left";
                $right = "right";
                if ($request->direction == "rtl") {
                    $left = "right";
                    $right = "left";
                }
                $Language->title = $request->title;
                $Language->direction = $request->direction;
                $Language->icon = trim(strtolower($request->icon));
                $Language->box_status = ($request->fields) ? 1 : 0;
                $Language->left = $left;
                $Language->right = $right;
                $Language->status = ($request->status) ? 1 : 0;
                $Language->updated_by = Auth::user()->id;
                $Language->save();

                return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                    ->with('doneMessage', __('backend.saveDone'))
                    ->with('active_tab', "languageSettingsTab");
            }
        }
        return redirect()->action('Dashboard\WebmasterSettingsController@edit')
            ->with('active_tab', "languageSettingsTab");
    }

    public function language_destroy($id)
    {
        if (@Auth::user()->permissionsGroup->delete_status) {
            $Language = Language::find($id);
            $Languages_count = Language::count();
            if ($Languages_count > 1) {
                if (!empty($Language)) {

                    // Delete BD Columns
                    $this->db_language_destroy($Language->code);

                    if ($Language->code == "en") {
                        $success = true;
                    } else {
                        $success = \File::deleteDirectory(base_path("resources/lang/" . $Language->code));
                    }
                    if ($success) {
                        $Language->delete();
                        return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                            ->with('doneMessage', __('backend.deleteDone'))
                            ->with('active_tab', "languageSettingsTab");
                    }
                }
            }
            return redirect()->action('Dashboard\WebmasterSettingsController@edit')
                ->with('errorMessage', __('backend.error'))
                ->with('active_tab', "languageSettingsTab");
        }
        return redirect()->action('Dashboard\WebmasterSettingsController@edit')
            ->with('active_tab', "languageSettingsTab");
    }

    public function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;


            // Loop through given data
            foreach ((array)$data as $key => $value) {

                // add KEY if not exist
                $KEY_EXIST = 0;
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $key) {
                        $KEY_EXIST = 1;
                    }
                }
                if (!$KEY_EXIST) {
                    $env[$key] = $key . "=";
                }

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    public function db_language_add($code)
    {
        $current_lang_code = @Helper::currentLanguage()->code;
        try {
            // topics table
            Schema::table('topics', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->longText('details_' . $code)->nullable();
                $table->string('seo_title_' . $code)->nullable();
                $table->string('seo_description_' . $code)->nullable();
                $table->string('seo_keywords_' . $code)->nullable();
                $table->string('seo_url_slug_' . $code)->nullable();
            });
            // copy data to new language columns
            if ($current_lang_code != "") {
                Topic::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                Topic::where('id', '>', 0)->update(['details_' . $code => DB::raw('details_' . $current_lang_code)]);
                Topic::where('id', '>', 0)->update(['seo_title_' . $code => DB::raw('seo_title_' . $current_lang_code)]);
                Topic::where('id', '>', 0)->update(['seo_description_' . $code => DB::raw('seo_description_' . $current_lang_code)]);
                Topic::where('id', '>', 0)->update(['seo_keywords_' . $code => DB::raw('seo_keywords_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // sections table
            Schema::table('sections', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->string('seo_title_' . $code)->nullable();
                $table->string('seo_description_' . $code)->nullable();
                $table->string('seo_keywords_' . $code)->nullable();
                $table->string('seo_url_slug_' . $code)->nullable();
            });
            // copy data to new language columns
            if ($current_lang_code != "") {
                Section::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                Section::where('id', '>', 0)->update(['seo_title_' . $code => DB::raw('seo_title_' . $current_lang_code)]);
                Section::where('id', '>', 0)->update(['seo_description_' . $code => DB::raw('seo_description_' . $current_lang_code)]);
                Section::where('id', '>', 0)->update(['seo_keywords_' . $code => DB::raw('seo_keywords_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // menus table
            Schema::table('menus', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Menu::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // maps table
            Schema::table('maps', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->text('details_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Map::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                Map::where('id', '>', 0)->update(['details_' . $code => DB::raw('details_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // countries table
            Schema::table('countries', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Country::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // banners table
            Schema::table('banners', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->text('details_' . $code)->nullable();
                $table->string('file_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Banner::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                Banner::where('id', '>', 0)->update(['details_' . $code => DB::raw('details_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // attach_files table
            Schema::table('attach_files', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                AttachFile::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // webmaster_section_fields table
            Schema::table('webmaster_section_fields', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->text('details_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                WebmasterSectionField::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                WebmasterSectionField::where('id', '>', 0)->update(['details_' . $code => DB::raw('details_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // webmaster_sections table
            Schema::table('webmaster_sections', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
                $table->string('seo_title_' . $code)->nullable();
                $table->string('seo_description_' . $code)->nullable();
                $table->string('seo_keywords_' . $code)->nullable();
                $table->string('seo_url_slug_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                WebmasterSection::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
                WebmasterSection::where('id', '>', 0)->update(['seo_title_' . $code => DB::raw('seo_title_' . $current_lang_code)]);
                WebmasterSection::where('id', '>', 0)->update(['seo_description_' . $code => DB::raw('seo_description_' . $current_lang_code)]);
                WebmasterSection::where('id', '>', 0)->update(['seo_keywords_' . $code => DB::raw('seo_keywords_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // webmaster_banners table
            Schema::table('webmaster_banners', function (Blueprint $table) use ($code) {
                $table->string('title_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                WebmasterBanner::where('id', '>', 0)->update(['title_' . $code => DB::raw('title_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }
        try {
            // settings table
            Schema::table('settings', function (Blueprint $table) use ($code) {
                $table->string('site_title_' . $code)->nullable();
                $table->string('site_desc_' . $code)->nullable();
                $table->text('site_keywords_' . $code)->nullable();
                $table->string('contact_t1_' . $code)->nullable();
                $table->string('contact_t7_' . $code)->nullable();
                $table->string('style_logo_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Setting::where('id', '>', 0)->update(['site_title_' . $code => DB::raw('site_title_' . $current_lang_code)]);
                Setting::where('id', '>', 0)->update(['site_desc_' . $code => DB::raw('site_desc_' . $current_lang_code)]);
                Setting::where('id', '>', 0)->update(['site_keywords_' . $code => DB::raw('site_keywords_' . $current_lang_code)]);
                Setting::where('id', '>', 0)->update(['contact_t1_' . $code => DB::raw('contact_t1_' . $current_lang_code)]);
                Setting::where('id', '>', 0)->update(['contact_t7_' . $code => DB::raw('contact_t7_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }

        try {
            // permissions table
            Schema::table('permissions', function (Blueprint $table) use ($code) {
                $table->string('home_details_' . $code)->nullable();
            });

            // copy data to new language columns
            if ($current_lang_code != "") {
                Permissions::where('id', '>', 0)->update(['home_details_' . $code => DB::raw('home_details_' . $current_lang_code)]);
            }
        } catch (\Exception $e) {
        }

        try {
            // empty old translation table
            DB::table('ltm_translations')->truncate();

        } catch (\Exception $e) {
        }
        return true;
    }

    public function db_language_destroy($code)
    {
        $current_lang_code = @Helper::currentLanguage()->code;
        try {
            if ($current_lang_code == $code) {
                $df_language = Language::first();
                if (!empty($df_language)) {
                    \Session::put('lang', $df_language->code);
                }
            }
        } catch (\Exception $e) {
        }
        try {
            // topics table
            Schema::table('topics', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('details_' . $code);
                $table->dropColumn('seo_title_' . $code);
                $table->dropColumn('seo_description_' . $code);
                $table->dropColumn('seo_keywords_' . $code);
                $table->dropColumn('seo_url_slug_' . $code);
            });
        } catch (\Exception $e) {
        }
        try {
            // sections table
            Schema::table('sections', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('seo_title_' . $code);
                $table->dropColumn('seo_description_' . $code);
                $table->dropColumn('seo_keywords_' . $code);
                $table->dropColumn('seo_url_slug_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // menus table
            Schema::table('menus', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // maps table
            Schema::table('maps', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('details_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // countries table
            if ($code != "en") {
                Schema::table('countries', function (Blueprint $table) use ($code) {
                    $table->dropColumn('title_' . $code);
                });
            }

        } catch (\Exception $e) {
        }
        try {
            // banners table
            Schema::table('banners', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('details_' . $code);
                $table->dropColumn('file_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // attach_files table
            Schema::table('attach_files', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // webmaster_section_fields table
            Schema::table('webmaster_section_fields', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('details_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // webmaster_sections table
            Schema::table('webmaster_sections', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
                $table->dropColumn('seo_title_' . $code);
                $table->dropColumn('seo_description_' . $code);
                $table->dropColumn('seo_keywords_' . $code);
                $table->dropColumn('seo_url_slug_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // webmaster_banners table
            Schema::table('webmaster_banners', function (Blueprint $table) use ($code) {
                $table->dropColumn('title_' . $code);
            });

        } catch (\Exception $e) {
        }
        try {
            // settings table
            Schema::table('settings', function (Blueprint $table) use ($code) {
                $table->dropColumn('site_title_' . $code);
                $table->dropColumn('site_desc_' . $code);
                $table->dropColumn('site_keywords_' . $code);
                $table->dropColumn('contact_t1_' . $code);
                $table->dropColumn('contact_t7_' . $code);
                $table->dropColumn('style_logo_' . $code);
            });

        } catch (\Exception $e) {
        }

        try {
            // empty old translation table
            DB::table('ltm_translations')->truncate();
        } catch (\Exception $e) {
        }

        return true;
    }

    public function seo_repair()
    {
        try {

            // WebmasterSection
            $WebmasterSections = WebmasterSection::all();
            foreach ($WebmasterSections as $WebmasterSection) {
                $id = $WebmasterSection->id;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($WebmasterSection->{"seo_url_slug_" . $ActiveLanguage->code} == "") {

                        $title_var = "title_" . @$ActiveLanguage->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');

                        if ($WebmasterSection->$title_var != "") {
                            $title = $WebmasterSection->$title_var;
                        } else {
                            $title = $WebmasterSection->$title_var2;
                        }

                        $WebmasterSection->{"seo_url_slug_" . $ActiveLanguage->code} = Helper::URLSlug($title, "section", $id);
                        $WebmasterSection->save();
                    }
                }
            }

            // Section
            $Sections = Section::all();
            foreach ($Sections as $Section) {
                $id = $Section->id;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($Section->{"seo_url_slug_" . $ActiveLanguage->code} == "") {

                        $title_var = "title_" . @$ActiveLanguage->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');

                        if ($Section->$title_var != "") {
                            $title = $Section->$title_var;
                        } else {
                            $title = $Section->$title_var2;
                        }

                        $Section->{"seo_url_slug_" . $ActiveLanguage->code} = Helper::URLSlug($title, "category", $id);
                        $Section->save();
                    }
                }
            }

            // Topic
            $Topics = Topic::all();
            foreach ($Topics as $Topic) {
                $id = $Topic->id;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($Topic->{"seo_url_slug_" . $ActiveLanguage->code} == "") {

                        $title_var = "title_" . @$ActiveLanguage->code;
                        $title_var2 = "title_" . env('DEFAULT_LANGUAGE');

                        if ($Topic->$title_var != "") {
                            $title = $Topic->$title_var;
                        } else {
                            $title = $Topic->$title_var2;
                        }

                        $Topic->{"seo_url_slug_" . $ActiveLanguage->code} = Helper::URLSlug($title, "topic", $id);
                        $Topic->save();
                    }
                }
            }
        } catch (\Exception $e) {

        }

        return redirect()->action('Dashboard\WebmasterSettingsController@edit')
            ->with('doneMessage', __('backend.seoFixUrlsDone'))
            ->with('active_tab', "SEOSettingTab");
    }

    public function mail_smtp_check(Request $request)
    {
        if ($request->mail_driver == "smtp" && $request->mail_host != "" && $request->mail_port != "") {
            try {
                function server_parse($socket, $expected_response)
                {
                    $server_response = '';
                    while (substr($server_response, 3, 1) != ' ') {
                        if (!($server_response = fgets($socket, 256))) {
                            return 'Error while fetching server response codes';
                        }
                    }

                    if (!(substr($server_response, 0, 3) == $expected_response)) {
                        return $server_response;
                    }
                }

                //Connect to the host on the specified port
                $smtpServer = $request->mail_host;
                $username = $request->mail_username;
                $password = $request->mail_password;
                $port = $request->mail_port;
                $timeout = 20;
                $output = "";

                $socket = fsockopen($smtpServer, $port, $errno, $errstr, $timeout);
                if (!$socket) {
                    return json_encode(array("stat" => "error", "error" => "$errstr ($errno)"));
                } else {

                    server_parse($socket, '220');

                    fwrite($socket, 'EHLO ' . $smtpServer . "\r\n");
                    $output .= server_parse($socket, '250');
                    if ($output != "") {
                        $output .= "<br>";
                    }
                    fwrite($socket, 'AUTH LOGIN' . "\r\n");
                    $output .= server_parse($socket, '334');
                    if ($output != "") {
                        $output .= "<br>";
                    }
                    fwrite($socket, base64_encode($username) . "\r\n");
                    $output .= server_parse($socket, '334');
                    if ($output != "") {
                        $output .= "<br>";
                    }
                    fwrite($socket, base64_encode($password) . "\r\n");
                    $output .= server_parse($socket, '235');

                    if ($output == "") {
                        return json_encode(array("stat" => "success"));
                    } else {
                        return json_encode(array("stat" => "error", "error" => $output));
                    }
                }
            } catch (\Exception $e) {
                return json_encode(array("stat" => "error", "error" => "$errstr ($errno)"));
            }
        }
        return json_encode(array("stat" => "error", "error" => "Failed .. no data to connect"));
    }

    public function mail_test(Request $request)
    {
        $WebmasterSetting = WebmasterSetting::find(1);
        if (!empty($WebmasterSetting)) {

            $WebmasterSetting->mail_driver = $request->mail_driver;
            $WebmasterSetting->mail_host = $request->mail_host;
            $WebmasterSetting->mail_port = $request->mail_port;
            $WebmasterSetting->mail_username = $request->mail_username;
            $WebmasterSetting->mail_password = $request->mail_password;
            $WebmasterSetting->mail_encryption = $request->mail_encryption;
            $WebmasterSetting->mail_no_replay = $request->mail_no_replay;
            $WebmasterSetting->save();


            $env_update = $this->changeEnv([
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_no_replay,
            ]);

            if ($request->mail_driver == "smtp" && $request->mail_host != "" && $request->mail_port != "") {
                try {
                    $email_subject = "Test Mail From " . env("APP_NAME");
                    $email_body = "This is a Test Mail \r\n
Mail Driver: " . $request->mail_driver . "
Mail Host: " . $request->mail_host . "
Mail Port: " . $request->mail_port . "
Mail Username: " . $request->mail_username . "
Email from: " . $request->mail_no_replay . "
Email to: " . $request->mail_test . "
";
                    $to_email = $request->mail_test;
                    $to_name = "";
                    $from_email = $request->mail_no_replay;
                    $from_name = env("APP_NAME");
                    Mail::send([], [], function ($message) use ($email_subject, $email_body, $to_email, $to_name, $from_email, $from_name) {
                        $message->from($from_email, $from_name)
                            ->to($to_email, $to_name)
                            ->subject($email_subject)
                            ->setBody($email_body);
                    });
                    return json_encode(array("stat" => "success"));
                } catch (\Exception $e) {
                    return json_encode(array("stat" => "error"));
                }
            }
        }
        return json_encode(array("stat" => "error"));
    }
}
