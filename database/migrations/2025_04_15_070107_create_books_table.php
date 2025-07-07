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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('author_id'); 
            $table->string('title');
            $table->string('slug');
            $table->string('availability');
            $table->string('price');
            $table->string('rating');
            $table->string('publisher');
            $table->string('country_of_publisher');
            $table->string('isbn');
            $table->string('isbn_10');
            $table->string('audience');
            $table->string('format');
            $table->string('language');
            $table->string('total_pages');
            $table->string('downloaded');
            $table->string('edition_number');
            $table->string('recommended');
            $table->text('description');
            $table->string('book_img')->nullable();     
            $table->string('book_upload')->nullable();  
            $table->boolean('status')->default('0');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
