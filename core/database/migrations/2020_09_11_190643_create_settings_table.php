<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title_ar')->nullable();
            $table->string('site_title_en')->nullable();
            $table->string('site_desc_ar')->nullable();
            $table->string('site_desc_en')->nullable();
            $table->text('site_keywords_ar')->nullable();
            $table->text('site_keywords_en')->nullable();
            $table->string('site_webmails')->nullable();
            $table->tinyInteger('notify_messages_status')->nullable();
            $table->tinyInteger('notify_comments_status')->nullable();
            $table->tinyInteger('notify_orders_status')->nullable();
            $table->tinyInteger('notify_table_status')->nullable();
            $table->tinyInteger('notify_private_status')->nullable();
            $table->string('site_url')->nullable();
            $table->tinyInteger('site_status');
            $table->text('close_msg')->nullable();
            $table->string('social_link1')->nullable();
            $table->string('social_link2')->nullable();
            $table->string('social_link3')->nullable();
            $table->string('social_link4')->nullable();
            $table->string('social_link5')->nullable();
            $table->string('social_link6')->nullable();
            $table->string('social_link7')->nullable();
            $table->string('social_link8')->nullable();
            $table->string('social_link9')->nullable();
            $table->string('social_link10')->nullable();
            $table->string('contact_t1_ar')->nullable();
            $table->string('contact_t1_en')->nullable();
            $table->string('contact_t3')->nullable();
            $table->string('contact_t4')->nullable();
            $table->string('contact_t5')->nullable();
            $table->string('contact_t6')->nullable();
            $table->string('contact_t7_ar')->nullable();
            $table->string('contact_t7_en')->nullable();

            $table->string('style_logo_ar')->nullable();
            $table->string('style_logo_en')->nullable();
            $table->string('style_fav')->nullable();;
            $table->string('style_apple')->nullable();
            $table->string('style_color1')->nullable();
            $table->string('style_color2')->nullable();
            $table->tinyInteger('style_type')->nullable();
            $table->tinyInteger('style_bg_type')->nullable();
            $table->string('style_bg_pattern')->nullable();
            $table->string('style_bg_color')->nullable();
            $table->string('style_bg_image')->nullable();
            $table->tinyInteger('style_subscribe')->nullable();
            $table->tinyInteger('style_footer')->nullable();
            $table->tinyInteger('style_header')->nullable();
            $table->string('style_footer_bg')->nullable();
            $table->tinyInteger('style_preload')->nullable();
            $table->longText('css')->nullable();

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
        Schema::dropIfExists('settings');
    }
}
