<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Section;
use App\Models\Topic;
use App\Models\WebmasterSection;
use Helper;


class SiteMapController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param string $lang
     * @return \Illuminate\Http\Response
     */
    public function siteMap($lang = "")
    {
        $lang = $this->getLanguage($lang);

        \Session::put('locale', $lang);

        $SiteMapDetails = "";
        $slug_var = "seo_url_slug_" . $lang;

        // HOME
        $url_link = url("");
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";

        // Main Site Sections
        $WebmasterSections = WebmasterSection::where("status", 1)->orderby('row_no', 'asc')->get();
        foreach ($WebmasterSections as $WebmasterSection) {
            if ($WebmasterSection->type != 4) {
                $url_link = Helper::sectionURL($WebmasterSection->id);
                $url_time = date("c", strtotime($WebmasterSection->updated_at));

                $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
</url>
            ";
            }
        }


        // Categories
        $Sections = Section::where("status", 1)->orderby('row_no', 'asc')->get();
        foreach ($Sections as $Section) {
            $url_link = Helper::categoryURL($Section->id);
            $url_time = date("c", strtotime($Section->updated_at));

            $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
</url>
            ";
        }

        // Topics

        // about
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "about");
        } else {
            $url_link = url("about");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // contact
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "contact");
        } else {
            $url_link = url("contact");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // privacy
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "privacy");
        } else {
            $url_link = url("privacy");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";
        // terms
        if ($lang != env('DEFAULT_LANGUAGE')) {
            $url_link = url("$lang/" . "terms");
        } else {
            $url_link = url("terms");
        }
        $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
</url>
            ";

        // All Other Topics

        $Topics = Topic::where([['status', 1], ['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])->orwhere([['status', 1], ['expire_date', null]])->orderby('row_no', 'asc')->get();
        foreach ($Topics as $Topic) {
            if (!empty($Topic->webmasterSection)) {
                if ($Topic->webmasterSection->type != 4) {
                    $url_link = Helper::topicURL($Topic->id);
                    $url_time = date("c", strtotime($Topic->updated_at));

                    $SiteMapDetails .= "
<url>
    <loc>$url_link</loc>
    <lastmod>$url_time</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
</url>
            ";
                }
            }
        }


        return response()->view("frontEnd.sitemap", compact("SiteMapDetails"))->header('Content-Type', 'text/xml');
    }

    /**
     * Language Check
     */
    public function getLanguage($lang)
    {
        // List of active languages for API
        $Language = Language::where("status", true)->where("code", $lang)->first();

        if ($lang == "" || empty($Language)) {
            $lang = env('DEFAULT_LANGUAGE');
        }
        return $lang;
    }
}
