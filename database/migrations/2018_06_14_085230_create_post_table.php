<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->unsigned()->nullable();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('slug_title')->unique()->nullable();
            $table->string('seo_title')->nullable();
            $table->text('description')->nullable();
            $table->longText('content_post')->nullable();
            $table->text('meta_des')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->boolean('active')->default(false);
            $table->string('url_img')->nullable();
            $table->integer('view')->default(0);
            $table->tinyInteger('type')->default(1);
            $table->integer('parent_id')->nullable()->index();
            $table->integer('rate')->default(0);
            $table->timestamps();
        });

        // Full Text Index
        DB::statement('ALTER TABLE posts ADD FULLTEXT fulltext_index (title, slug_title, seo_title, description, content_post, meta_des, meta_keyword)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
