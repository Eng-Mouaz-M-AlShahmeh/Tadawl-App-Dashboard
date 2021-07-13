<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WebmasterSetting;

class WebmasterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Default Webmaster Settings

        $settings = new WebmasterSetting();
        $settings->seo_status = true;
        $settings->analytics_status = true;
        $settings->banners_status = true;
        $settings->inbox_status = true;
        $settings->calendar_status = true;
        $settings->settings_status = true;
        $settings->newsletter_status = true;
        $settings->members_status = false;
        $settings->orders_status = false;
        $settings->shop_status = false;
        $settings->shop_settings_status = false;
        $settings->default_currency_id = "5";
        $settings->languages_by_default = "en";

        $settings->header_menu_id = "1";
        $settings->footer_menu_id = "2";
        $settings->home_banners_section_id = "1";
        $settings->home_text_banners_section_id = "2";
        $settings->side_banners_section_id = "3";
        $settings->contact_page_id = "2";
        $settings->newsletter_contacts_group = "1";
        $settings->new_comments_status = true;
        $settings->home_content1_section_id = "7";
        $settings->home_content2_section_id = "4";
        $settings->home_content3_section_id = "9";
        $settings->home_contents_per_page = "20";
        $settings->latest_news_section_id = "3";
        $settings->links_status = false;
        $settings->register_status = false;
        $settings->permission_group = "3";
        $settings->api_status = false;
        $settings->api_key = "402784613679330";

        $settings->mail_driver = "smtp";
        $settings->mail_host = "";
        $settings->mail_port = "";
        $settings->mail_username = "";
        $settings->mail_password = "";
        $settings->mail_encryption = "";
        $settings->mail_no_replay = "noreply@site.com";
        $settings->nocaptcha_status = false;
        $settings->nocaptcha_secret = "";
        $settings->nocaptcha_sitekey = "";
        $settings->google_tags_status = false;
        $settings->google_tags_id = "";
        $settings->google_analytics_code = "";

        $settings->login_facebook_status = false;
        $settings->login_facebook_client_id = "";
        $settings->login_facebook_client_secret = "";

        $settings->login_twitter_status = false;
        $settings->login_twitter_client_id = "";
        $settings->login_twitter_client_secret = "";

        $settings->login_google_status = false;
        $settings->login_google_client_id = "";
        $settings->login_google_client_secret = "";

        $settings->login_linkedin_status = false;
        $settings->login_linkedin_client_id = "";
        $settings->login_linkedin_client_secret = "";

        $settings->login_github_status = false;
        $settings->login_github_client_id = "";
        $settings->login_github_client_secret = "";

        $settings->login_bitbucket_status = false;
        $settings->login_bitbucket_client_id = "";
        $settings->login_bitbucket_client_secret = "";

        $settings->dashboard_link_status = true;
        $settings->timezone = "UTC";

        $settings->version = "8.2.0";

        $settings->mail_title = '{title}';
        $settings->mail_template = '{details}';


        $settings->created_by = 1;

        $settings->save();
    }
}
