<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->text('keywords');
            $table->longText('description');
            $table->text('title');
            $table->string('phone',30);
            $table->string('whatsapp',30);
            $table->text('facebook');
            $table->text('instagram');
            $table->text('linkedin');
            $table->text('form_email');
            $table->text('email');            
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
        Schema::dropIfExists('configurations');
    }
}