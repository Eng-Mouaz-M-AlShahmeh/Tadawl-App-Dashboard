<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebmasterBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webmaster_banners', function (Blueprint $table) {
            $table->id();
            $table->integer('row_no');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->integer('width');
            $table->integer('height');
            $table->tinyInteger('desc_status');
            $table->tinyInteger('link_status');
            $table->tinyInteger('type');
            $table->tinyInteger('icon_status');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('webmaster_banners');
    }
}
