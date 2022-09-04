<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->text('second_content')->nullable();
            $table->text('third_content')->nullable();
            $table->text('info')->nullable();
            $table->text('system_l')->nullable();
            $table->text('system_b')->nullable();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('downloads')->default(0);
            $table->text('files_setup')->nullable();
            $table->text('files_info')->nullable();
            $table->text('download')->nullable();
            $table->text('tags')->nullable();
        });

        Schema::create('postGallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        Schema::create('postIcon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('icon');
            $table->string('caption');
            $table->string('content');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postGallery');
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['second_content','third_content','info','system_l','system_b','likes','dislikes','downloads','files_setup','files_info','download','tags']);
        });
    }
}
