<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('location')->nullable();
      $table->string('name')->nullable();
      $table->string('cnpj',30)->nullable();
      $table->longText('description')->nullable();
      $table->string('item')->nullable();
      $table->string('image')->nullable();
      $table->string('CEP',30)->nullable();
      $table->text('street')->nullable();
      $table->text('city')->nullable();
      $table->text('state')->nullable();
      $table->integer('number')->nullable();
      $table->text('district')->nullable();
      $table->string('video')->nullable();
      $table->string('instagram')->nullable();
      $table->string('facebook')->nullable();
      $table->string('phone',30)->nullable();
      $table->boolean('active')->nullable()->default(0);
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
      Schema::dropIfExists('pages');
  }
}

