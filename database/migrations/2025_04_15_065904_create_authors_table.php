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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('designation');
            $table->string('dob');
            $table->string('country');
            $table->string('email');
            $table->string('phone');
            $table->text('description');
            $table->string('author_feature');
            $table->string('facebook_id')->nullable();
            $table->string('twitter_id')->nullable();
            $table->string('youtube_id')->nullable();
            $table->string('pinterest_id')->nullable();
            $table->string('author_img')->nullable();
            $table->boolean('status')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
