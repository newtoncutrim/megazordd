<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('file_products', function (Blueprint $table) {
            $table->id();
            $table->string('gallery')->nullable(); // URL da galeria de fotos
            $table->string('attachments_pdfs')->nullable(); // URLs dos PDFs
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('file_products', function(Blueprint $table){
            $table->dropForeign(['product_id']);
        });
        Schema::dropIfExists('file_products');
    }
};
