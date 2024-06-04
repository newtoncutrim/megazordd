<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('blog_posts', function (Blueprint $table) {
      $table->increments('id');
      $table->boolean('active')->nullable()->default(0);
      $table->string('slug');
      $table->string('blog_category_id');
      $table->string('name')->nullable();
      $table->string('lead')->nullable();
      $table->longText('description');
      $table->string('image');
      $table->string('video')->nullable();
      $table->string('date');
      $table->string('user');
      $table->string('time');
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
      Schema::dropIfExists('blog_posts');
  }
}

