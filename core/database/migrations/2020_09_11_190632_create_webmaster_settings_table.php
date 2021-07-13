<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebmasterSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmaster_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('seo_status');
            $table->tinyInteger('analytics_status');
            $table->tinyInteger('banners_status');
            $table->tinyInteger('inbox_status');
            $table->tinyInteger('calendar_status');
            $table->tinyInteger('settings_status');
            $table->tinyInteger('newsletter_status');
            $table->tinyInteger('members_status');
            $table->tinyInteger('orders_status');
            $table->tinyInteger('shop_status');
            $table->tinyInteger('shop_settings_status');
            $table->integer('default_currency_id');
            $table->string('languages_by_default');
            $table->integer('latest_news_section_id');
            $table->integer('header_menu_id');
            $table->integer('footer_menu_id');
            $table->integer('home_banners_section_id');
            $table->integer('home_text_banners_section_id');
            $table->integer('side_banners_section_id');
            $table->integer('contact_page_id');
            $table->integer('newsletter_contacts_group');
            $table->tinyInteger('new_comments_status');
            $table->tinyInteger('links_status');
            $table->tinyInteger('register_status');
            $table->integer('permission_group');
            $table->tinyInteger('api_status');
            $table->string('api_key');
            $table->integer('home_content1_section_id');
            $table->integer('home_content2_section_id');
            $table->integer('home_content3_section_id');
            $table->integer('home_contents_per_page');

            $table->string('mail_driver');
            $table->string('mail_host');
            $table->string('mail_port');
            $table->string('mail_username');
            $table->string('mail_password');
            $table->string('mail_encryption');
            $table->string('mail_no_replay');
            $table->string('mail_title')->nullable();
            $table->longText('mail_template')->nullable();
            $table->tinyInteger('nocaptcha_status');
            $table->string('nocaptcha_secret');
            $table->string('nocaptcha_sitekey');
            $table->tinyInteger('google_tags_status');
            $table->string('google_tags_id');
            $table->text('google_analytics_code');

            $table->tinyInteger('login_facebook_status');
            $table->string('login_facebook_client_id');
            $table->string('login_facebook_client_secret');

            $table->tinyInteger('login_twitter_status');
            $table->string('login_twitter_client_id');
            $table->string('login_twitter_client_secret');

            $table->tinyInteger('login_google_status');
            $table->string('login_google_client_id');
            $table->string('login_google_client_secret');

            $table->tinyInteger('login_linkedin_status');
            $table->string('login_linkedin_client_id');
            $table->string('login_linkedin_client_secret');

            $table->tinyInteger('login_github_status');
            $table->string('login_github_client_id');
            $table->string('login_github_client_secret');

            $table->tinyInteger('login_bitbucket_status');
            $table->string('login_bitbucket_client_id');
            $table->string('login_bitbucket_client_secret');

            $table->tinyInteger('dashboard_link_status');
            $table->string('timezone');
            $table->string('version',20)->nullable();


            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webmaster_settings');
    }
}
