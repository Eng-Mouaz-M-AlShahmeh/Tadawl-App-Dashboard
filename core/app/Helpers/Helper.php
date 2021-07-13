<?php

// This class file to define all general functions

namespace App\Helpers;

use App;
use App\Models\AnalyticsPage;
use App\Models\AnalyticsVisitor;
use App\Models\Banner;
use App\Models\Country;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Section;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\Webmail;
use App\Models\Language;
use App\Models\WebmasterSection;
use App\Models\WebmasterSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Auth;
use GeoIP;

class Helper
{

    static function GeneralWebmasterSettings($var)
    {
        $WebmasterSetting = WebmasterSetting::find(1);
        return $WebmasterSetting->$var;
    }

    static function GeneralSiteSettings($var)
    {
        $Setting = Setting::find(1);
        return $Setting->$var;
    }

    // Get Events Alerts
    static function eventsAlerts()
    {
        if (@Auth::user()->permissionsGroup->view_status) {
            $Events = Event::where('created_by', '=', Auth::user()->id)->where('start_date', '>=', date('Y-m-d H:i:s'))->orderby('start_date', 'asc')->limit(10)->get();
        } else {
            $Events = Event::where('start_date', '>=', date('Y-m-d H:i:s'))->orderby('start_date', 'asc')->limit(10)->get();
        }
        return $Events;
    }

    // Get Webmails Alerts
    static function webmailsAlerts()
    {

        //List of all Webmails
        if (@Auth::user()->permissionsGroup->view_status) {
            $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')->where('status', '=',
                0)
                ->where('cat_id', '=', 0)->limit(4)->get();
        } else {
            $Webmails = Webmail::orderby('id', 'desc')->where('status', '=', 0)
                ->where('cat_id', '=', 0)->limit(4)->get();
        }

        return $Webmails;
    }

    // Get Webmails Alerts
    static function webmailsNewCount()
    {
        //List of all Webmails
        if (@Auth::user()->permissionsGroup->view_status) {
            $Webmails = Webmail::where('created_by', '=', Auth::user()->id)->orderby('id', 'desc')->where('status', '=',
                0)->where('cat_id', '=', 0)->get();
        } else {
            $Webmails = Webmail::orderby('id', 'desc')->where('status', '=', 0)->where('cat_id', '=', 0)->get();
        }
        return count($Webmails);
    }

    // Banners array List
    static function BannersList($BannersSettingsId)
    {
        return Banner::where('section_id', $BannersSettingsId)->where('status', 1)->orderby('row_no', 'asc')->get();
    }

    // Menu array List
    static function MenuList($GroupId)
    {
        return Menu::where('father_id', $GroupId)->where('status', 1)->orderby('row_no', 'asc')->get();
    }

    // detect browser
    static function getBrowser()
    {
        // check if IE 8 - 11+
        preg_match('/Trident\/(.*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if ($matches) {
            $version = intval($matches[1]) + 4;     // Trident 4 for IE8, 5 for IE9, etc
            return 'Internet Explorer ' . ($version < 11 ? $version : $version);
        }

        preg_match('/MSIE (.*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if ($matches) {
            return 'Internet Explorer ' . intval($matches[1]);
        }

        // check if Firefox, Opera, Chrome, Safari
        foreach (array('Firefox', 'OPR', 'Chrome', 'Safari') as $browser) {
            preg_match('/' . $browser . '/', $_SERVER['HTTP_USER_AGENT'], $matches);
            if ($matches) {
                return str_replace('OPR', 'Opera',
                    $browser);   // we don't care about the version, because this is a modern browser that updates itself unlike IE
            }
        }
    }

    // detect OS
    static function getOS()
    {

        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform = "unknown";

        $os_array = array(
            '/windows nt 10/i' => 'Windows 10',
            '/windows nt 6.3/i' => 'Windows 8.1',
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($os_array as $regex => $value) {

            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }

        }

        return $os_platform;

    }

    // Visitors Data
    static function SaveVisitorInfo($PageTitle)
    {
        if (env('GEOIP_STATUS', false)) {
            $visitor_ip = $_SERVER['REMOTE_ADDR'];
            $current_page_full_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $page_load_time = round((microtime(true) - LARAVEL_START), 8);

            // Check is it already saved today to visitors?
            $SavedVisitor = AnalyticsVisitor::where('ip', '=', $visitor_ip)->where('date', '=', date('Y-m-d'))->first();
            if (empty($SavedVisitor)) {

                // New to analyticsVisitors
                try {
                    $visitor_local_ip_details = AnalyticsVisitor::where('ip', $visitor_ip)->first();
                    if (!empty($visitor_local_ip_details)) {
                        $visitor_city = $visitor_local_ip_details->city;
                        $visitor_region = $visitor_local_ip_details->region;
                        $visitor_country_code = $visitor_local_ip_details->country;
                        $visitor_country = "unknown";
                        if ($visitor_country_code != "") {
                            $v_country = Country::where('code', '=', $visitor_country_code)->first();
                            if (!empty($v_country)) {
                                $visitor_country = $v_country->title_en;
                            }
                        }
                        $visitor_loc_0 = $visitor_local_ip_details->location_cor1;
                        $visitor_loc_1 = $visitor_local_ip_details->location_cor2;
                        $visitor_org = $visitor_local_ip_details->org;
                        $visitor_hostname = $visitor_local_ip_details->hostname;
                    } else {

                        $visitor_ip_details = GeoIP("156.208.16.114");;

                        $visitor_city = @$visitor_ip_details->city;
                        if ($visitor_city == "") {
                            $visitor_city = "unknown";
                        }
                        $visitor_region = @$visitor_ip_details->state_name;
                        if ($visitor_region == "") {
                            $visitor_region = "unknown";
                        }
                        $visitor_country_code = @$visitor_ip_details->iso_code;
                        if ($visitor_country_code == "") {
                            $visitor_country_code = "unknown";
                        }
                        $visitor_country = @$visitor_ip_details->country;
                        if ($visitor_country == "") {
                            $visitor_country = "unknown";
                        }

                        $visitor_loc_0 = @$visitor_ip_details->lat;
                        if ($visitor_loc_0 == "") {
                            $visitor_loc_0 = "unknown";
                        }
                        $visitor_loc_1 = @$visitor_ip_details->lon;
                        if ($visitor_loc_1 == "") {
                            $visitor_loc_1 = "unknown";
                        }

                        $visitor_org = @$visitor_ip_details->timezone;
                        if ($visitor_org == "") {
                            $visitor_org = "unknown";
                        }
                        $visitor_hostname = @$visitor_ip_details->continent;
                        if ($visitor_hostname == "") {
                            $visitor_hostname = "unknown";
                        }
                    }
                } catch (Exception $e) {
                    $visitor_city = "unknown";
                    $visitor_region = "unknown";
                    $visitor_country_code = "unknown";
                    $visitor_country = "unknown";
                    $visitor_loc_0 = "unknown";
                    $visitor_loc_1 = "unknown";
                    $visitor_org = "unknown";
                    $visitor_hostname = "unknown";
                }

                $visitor_referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "unknown";
                $visitor_browser = Helper::getBrowser();
                $visitor_os = Helper::getOS();
                $visitor_screen_res = "unknown";

                // Start saving to database
                $Visitor = new AnalyticsVisitor;
                $Visitor->ip = $visitor_ip;
                $Visitor->city = $visitor_city;
                $Visitor->country_code = $visitor_country_code;
                $Visitor->country = $visitor_country;
                $Visitor->region = $visitor_region;
                $Visitor->location_cor1 = $visitor_loc_0;
                $Visitor->location_cor2 = $visitor_loc_1;
                $Visitor->os = $visitor_os;
                $Visitor->browser = $visitor_browser;
                $Visitor->resolution = $visitor_screen_res;
                $Visitor->referrer = $visitor_referrer;
                $Visitor->hostname = $visitor_hostname;
                $Visitor->org = $visitor_org;
                $Visitor->date = date('Y-m-d');
                $Visitor->time = date('H:i:s');
                $Visitor->save();

                // Start saving page info to database
                $VisitedPage = new AnalyticsPage;
                $VisitedPage->visitor_id = $Visitor->id;
                $VisitedPage->ip = $visitor_ip;
                $VisitedPage->title = $PageTitle;
                $VisitedPage->name = "unknown";
                $VisitedPage->query = $current_page_full_link;
                $VisitedPage->load_time = $page_load_time;
                $VisitedPage->date = date('Y-m-d');
                $VisitedPage->time = date('H:i:s');
                $VisitedPage->save();


            } else {
                // Already Saved to analyticsVisitors
                // Check if page saved
                $Savedpage = AnalyticsPage::where('visitor_id', '=', $SavedVisitor->id)->where('ip', '=',
                    $visitor_ip)->where('date', '=', date('Y-m-d'))->where('query', '=', $current_page_full_link)->first();
                if (empty($Savedpage)) {
                    $VisitedPage = new AnalyticsPage;
                    $VisitedPage->visitor_id = $SavedVisitor->id;
                    $VisitedPage->ip = $visitor_ip;
                    $VisitedPage->title = $PageTitle;
                    $VisitedPage->name = "unknown";
                    $VisitedPage->query = $current_page_full_link;
                    $VisitedPage->load_time = $page_load_time;
                    $VisitedPage->date = date('Y-m-d');
                    $VisitedPage->time = date('H:i:s');
                    $VisitedPage->save();
                }

            }
        }
    }

    // Videos Check Functions

    static function Get_youtube_video_id($url)
    {
        if (preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url)) {
            $pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
            preg_match($pattern, $url, $matches);
            if (count($matches) && strlen($matches[7]) == 11) {
                return $matches[7];
            }
        }

        return '';
    }

    static function Get_vimeo_video_id($url)
    {
        if (preg_match('/vimeo\.com/i', $url)) {
            $pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
            preg_match($pattern, $url, $matches);
            if (count($matches)) {
                return $matches[2];
            }
        }

        return '';
    }

    // Social Share links
    static function SocialShare($social, $title)
    {
        $shareLink = "";
        $URL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        switch ($social) {
            case "facebook":
                $shareLink = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($URL);
                break;
            case "twitter":
                $shareLink = "https://twitter.com/intent/tweet?text=$title&url=" . urlencode($URL);
                break;
            case "google":
                $shareLink = "https://plus.google.com/share?url=" . urlencode($URL);
                break;
            case "linkedin":
                $shareLink = "http://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($URL) . "&title=$title";
                break;
            case "tumblr":
                $shareLink = "http://www.tumblr.com/share/link?url=" . urlencode($URL);
                break;
        }

        return $shareLink;
    }

    static function GetIcon($path, $file)
    {
        $ext = strrchr($file, ".");
        $ext = strtolower($ext);
        $icon = "<i class=\"fa fa-file-o\"></i>";
        if ($ext == ".pdf") {
            $icon = "<i class=\"fa fa-file-pdf-o\" style='color: red;font-size: 20px'></i>";
        }
        if ($ext == '.png' or $ext == '.jpg' or $ext == '.jpeg' or $ext == '.gif') {
            $icon = "<img src='$path/$file' style='width: auto;height: 20px' title=''>";
        }
        if ($ext == ".xls" or $ext == '.xlsx') {
            $icon = "<i class=\"fa fa-file-excel-o\" style='color: green;font-size: 20px'></i>";
        }
        if ($ext == ".ppt" or $ext == '.pptx' or $ext == '.pptm') {
            $icon = "<i class=\"fa fa-file-powerpoint-o\" style='color: #1066E7;font-size: 20px'></i>";
        }
        if ($ext == ".doc" or $ext == '.docx') {
            $icon = "<i class=\"fa fa-file-word-o\" style='color: #0EA8DD;font-size: 20px'></i>";
        }
        if ($ext == ".zip" or $ext == '.rar') {
            $icon = "<i class=\"fa fa-file-zip-o\" style='color: #C8841D;font-size: 20px'></i>";
        }
        if ($ext == ".txt" or $ext == '.rtf') {
            $icon = "<i class=\"fa fa-file-text-o\" style='color: #7573AA;font-size: 20px'></i>";
        }
        if ($ext == ".mp3" or $ext == '.wav') {
            $icon = "<i class=\"fa fa-file-audio-o\" style='color: #8EA657;font-size: 20px'></i>";
        }
        if ($ext == ".mp4" or $ext == '.avi') {
            $icon = "<i class=\"fa fa-file-video-o\" style='color: #D30789;font-size: 20px'></i>";
        }
        return $icon;

    }

    static function URLSlug($url, $type = "", $id = 0, $num = 0)
    {
        $Check_SEO_st = true;

        $seo_url_slug = Str::slug($url, '-');

        $ReservedURLs = array(
            "home",
            "about",
            "privacy",
            "terms",
            "contact",
            "search",
            "comment",
            "order",
            "sitemap"
        );


        if ($type == "section" && $id > 0) {
            // .. ..  Webmaster Sections
            if (count(Helper::languagesList()) > 0) {
                $check_WebmasterSection = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_WebmasterSection = WebmasterSection::where([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    } else {
                        $check_WebmasterSection = $check_WebmasterSection->orWhere([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    }
                    $i++;
                }
                $check_WebmasterSection_count = $check_WebmasterSection->count();
                if ($check_WebmasterSection_count > 0) {
                    $Check_SEO_st = false;
                }
            }
        } else {
            // .. ..  Webmaster Sections
            if (count(Helper::languagesList()) > 0) {
                $check_WebmasterSection = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_WebmasterSection = WebmasterSection::where('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    } else {
                        $check_WebmasterSection = $check_WebmasterSection->orWhere('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    }
                    $i++;
                }
                $check_WebmasterSection_count = $check_WebmasterSection->count();
                if ($check_WebmasterSection_count > 0) {
                    $Check_SEO_st = false;
                }
            }

        }

        if ($type == "category" && $id > 0) {
            // .. ..  Sections
            if (count(Helper::languagesList()) > 0) {
                $check_Section = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_Section = Section::where([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    } else {
                        $check_Section = $check_Section->orWhere([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    }
                    $i++;
                }
                $check_Section_count = $check_Section->count();
                if ($check_Section_count > 0) {
                    $Check_SEO_st = false;
                }
            }
        } else {
            // .. ..  Sections
            if (count(Helper::languagesList()) > 0) {
                $check_Section = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_Section = Section::where('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    } else {
                        $check_Section = $check_Section->orWhere('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    }
                    $i++;
                }
                $check_Section_count = $check_Section->count();
                if ($check_Section_count > 0) {
                    $Check_SEO_st = false;
                }
            }
        }

        if ($type == "topic" && $id > 0) {
            // .. ..  Topics
            if (count(Helper::languagesList()) > 0) {
                $check_Topic = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_Topic = Topic::where([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    } else {
                        $check_Topic = $check_Topic->orWhere([['seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug], ['id', '!=', $id]]);
                    }
                    $i++;
                }
                $check_Topic_count = $check_Topic->count();
                if ($check_Topic_count > 0) {
                    $Check_SEO_st = false;
                }
            }
        } else {
            // .. ..  Topics
            if (count(Helper::languagesList()) > 0) {
                $check_Topic = [];
                $i = 0;
                foreach (Helper::languagesList() as $ActiveLanguage) {
                    if ($i == 0) {
                        $check_Topic = Topic::where('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    } else {
                        $check_Topic = $check_Topic->orWhere('seo_url_slug_' . $ActiveLanguage->code, $seo_url_slug);
                    }
                    $i++;
                }
                $check_Topic_count = $check_Topic->count();
                if ($check_Topic_count > 0) {
                    $Check_SEO_st = false;
                }
            }
        }

        if (in_array($seo_url_slug, $ReservedURLs)) {
            $Check_SEO_st = false;
        }

        if ($seo_url_slug == "") {
            $Check_SEO_st = true;
        }

        if ($Check_SEO_st) {
            return $seo_url_slug;
        } else {
            $url = preg_replace('/-' . $num . '$/', '', $url);
            $num++;
            $url = $url . "-" . $num;
            return Helper::URLSlug($url, $type, $id, $num);
        }
    }

    static function currentLanguage()
    {
        $locale = App::getLocale();
        if (\Session::has('lang')) {
            $locale = \Session::get('lang');
        }
        $Language = Language::where("code", $locale)->first();
        if (empty($Language)) {
            $Language = Language::where("code", env('DEFAULT_LANGUAGE', 'en'))->first();
        }
        return $Language;
    }

    static function LangFromCode($code)
    {
        return Language::where("code", $code)->first();
    }

    static function languagesList()
    {
        return Language::where("status", true)->orderby('id', 'asc')->get();
    }

    static function languageName($Language)
    {
        $language_title = "<span class='label light text-dark lang-label'>";
        if (!empty($Language)) {
            if ($Language->icon != "") {
                $language_title .= "<img src=\"" . asset('assets/dashboard/images/flags/' . $Language->icon . '.svg') . "\" alt=\"\">";
            }
            $language_title .= " <small>" . $Language->title . "</small></span>";
        }
        return $language_title;
    }

    static function sectionURL($id, $lang = "")
    {
        $section_url = "";
        try {
            $title_var = "title_" . @Helper::currentLanguage()->code;
            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            if ($lang == "") {
                $lang = @Helper::currentLanguage()->code;
            }
            $WebmasterSection = WebmasterSection::find($id);
            if (!empty($WebmasterSection)) {
                if ($WebmasterSection->$title_var != "") {
                    $title = $WebmasterSection->$title_var;
                } else {
                    $title = $WebmasterSection->$title_var2;
                }

                if ($WebmasterSection->{'seo_url_slug_' . $lang} != "") {
                    $slug = $WebmasterSection->{'seo_url_slug_' . $lang};
                } else {
                    $slug = $WebmasterSection->{'seo_url_slug_' . env('DEFAULT_LANGUAGE')};
                }
                if ($slug == "") {
                    $slug = Str::slug($title, '-');
                }
                if (Helper::GeneralWebmasterSettings("links_status")) {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $section_url = url($lang . "/" . $slug);
                    } else {
                        $section_url = url($slug);
                    }
                } else {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $section_url = url($lang . "/" . $slug);
                    } else {
                        $section_url = url($slug);
                    }
                }
            }
        } catch (\Exception $e) {

        }
        return $section_url;
    }

    static function categoryURL($id, $lang = "")
    {
        $category_url = "";
        try {
            $title_var = "title_" . @Helper::currentLanguage()->code;
            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            if ($lang == "") {
                $lang = @Helper::currentLanguage()->code;
            }
            $Category = Section::find($id);
            if (!empty($Category)) {
                if ($Category->$title_var != "") {
                    $title = $Category->$title_var;
                } else {
                    $title = $Category->$title_var2;
                }
                if ($Category->{'seo_url_slug_' . $lang} != "") {
                    $slug = $Category->{'seo_url_slug_' . $lang};
                } else {
                    $slug = $Category->{'seo_url_slug_' . env('DEFAULT_LANGUAGE')};
                }
                if ($slug == "") {
                    $slug = Str::slug($title, '-');
                }

                $WebmasterSection_slug = "NULL";
                $WebmasterSection = $Category->WebmasterSection;
                if (!empty($WebmasterSection)) {
                    if ($WebmasterSection->$title_var != "") {
                        $S_title = $WebmasterSection->$title_var;
                    } else {
                        $S_title = $WebmasterSection->$title_var2;
                    }

                    if ($WebmasterSection->{'seo_url_slug_' . $lang} != "") {
                        $WebmasterSection_slug = $WebmasterSection->{'seo_url_slug_' . $lang};
                    } else {
                        $WebmasterSection_slug = $WebmasterSection->{'seo_url_slug_' . env('DEFAULT_LANGUAGE')};
                    }
                    if ($WebmasterSection_slug == "") {
                        $WebmasterSection_slug = Str::slug($S_title, '-');
                    }
                }
                if (Helper::GeneralWebmasterSettings("links_status")) {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $category_url = url($lang . "/" . $slug);
                    } else {
                        $category_url = url($slug);
                    }
                } else {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $category_url = route('FrontendTopicsByCatWithLang', ["lang" => $lang, "section" => $WebmasterSection_slug, "cat" => $Category->id]);
                    } else {
                        $category_url = route('FrontendTopicsByCat', ["section" => $WebmasterSection_slug, "cat" => $Category->id]);
                    }
                }
            }

        } catch (\Exception $e) {

        }
        return $category_url;
    }

    static function topicURL($id, $lang = "")
    {
        $topic_url = "";
        try {
            $title_var = "title_" . @Helper::currentLanguage()->code;
            $title_var2 = "title_" . env('DEFAULT_LANGUAGE');
            if ($lang == "") {
                $lang = @Helper::currentLanguage()->code;
            }
            $Topic = Topic::find($id);
            if (!empty($Topic)) {
                if ($Topic->$title_var != "") {
                    $title = $Topic->$title_var;
                } else {
                    $title = $Topic->$title_var2;
                }
                if ($Topic->{'seo_url_slug_' . $lang} != "") {
                    $slug = $Topic->{'seo_url_slug_' . $lang};
                } else {
                    $slug = $Topic->{'seo_url_slug_' . env('DEFAULT_LANGUAGE')};
                }
                if ($slug == "") {
                    $slug = Str::slug($title, '-');
                }

                $WebmasterSection_slug = "NULL";
                $WebmasterSection = $Topic->WebmasterSection;
                if (!empty($WebmasterSection)) {
                    if ($WebmasterSection->$title_var != "") {
                        $S_title = $WebmasterSection->$title_var;
                    } else {
                        $S_title = $WebmasterSection->$title_var2;
                    }
                    if ($WebmasterSection->{'seo_url_slug_' . $lang} != "") {
                        $WebmasterSection_slug = $WebmasterSection->{'seo_url_slug_' . $lang};
                    } else {
                        $WebmasterSection_slug = $WebmasterSection->{'seo_url_slug_' . env('DEFAULT_LANGUAGE')};
                    }
                    if ($WebmasterSection_slug == "") {
                        $WebmasterSection_slug = Str::slug($S_title, '-');
                    }
                }
                if (Helper::GeneralWebmasterSettings("links_status")) {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $topic_url = url($lang . "/" . $slug);
                    } else {
                        $topic_url = url($slug);
                    }
                } else {
                    if ($lang != env('DEFAULT_LANGUAGE')) {
                        $topic_url = route('FrontendTopicByLang', ["lang" => $lang, "section" => $WebmasterSection_slug, "id" => $Topic->id]);
                    } else {
                        $topic_url = route('FrontendTopic', ["section" => $WebmasterSection_slug, "id" => $Topic->id]);
                    }
                }
            }
        } catch (\Exception $e) {

        }
        return $topic_url;
    }

    static function formatDate($date = "")
    {
        if ($date != "") {
            $format = env("DATE_FORMAT", "Y-m-d");
            return date($format, strtotime($date));
        }
        return "";
    }

    static function dateForDB($date = "", $withTime = 0)
    {
        if ($date != "") {
            try {
                $format = env("DATE_FORMAT", "Y-m-d");
                if ($withTime) {
                    return Carbon::createFromFormat($format . " h:i A", $date)->format('Y-m-d H:i:s');
                } else {
                    return Carbon::createFromFormat($format, $date)->format('Y-m-d');
                }
            } catch (\Exception $e) {

            }
        }
        return "";
    }

    static function jsDateFormat()
    {
        $format = env("DATE_FORMAT", "Y-m-d");
        $format = str_replace("Y", "YYYY", $format);
        $format = str_replace("m", "MM", $format);
        $format = str_replace("d", "DD", $format);
        return $format;
    }
}


?>
