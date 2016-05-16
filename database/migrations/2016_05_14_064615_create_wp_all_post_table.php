<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpAllPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wp_all_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id');
            $table->bigInteger('post_author');
            $table->dateTime('post_date');
            $table->dateTime('post_date_gmt');
            $table->longText('post_content');
            $table->mediumText('post_title');
            $table->string('ping_status',20);
            $table->string('post_name',20);
            $table->string('post_type',20);
            $table->string('contributor_message',50);
            $table->text('description');
            $table->integer('target');
            $table->text('budget');
            $table->string('launch_status',20);
            $table->dateTime('launch_status_date');
            $table->string('social_media_data',50);
            $table->text('team');
            $table->text('faq');
            $table->text('campaign_foreign');
            $table->text('video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wp_all_post');
    }
}
