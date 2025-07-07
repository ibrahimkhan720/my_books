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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('fullname'); 
            $table->string('designation'); 
            $table->string('telephone');
            $table->string('mobile'); 
            $table->string('email'); 
            $table->string('facebook_id')->nullable(); 
            $table->string('twitter_id')->nullable(); 
            $table->string('pinterest_id')->nullable(); 
            $table->string('team_img')->nullable(); 
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
