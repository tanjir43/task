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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200)->nullable();
            $table->enum('for_whom', ['male', 'female', 'other','all'])->default('all'); #specify separetly
            $table->string('description', 500)->nullable();
            $table->string('location', 200)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->tinyInteger('status')->default(1);
            
            
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->boolean('is_specific')->default(false); #if true then only specific by event will be area wise 
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->foreignId('media_id')->nullable()->constrained('media');

            $table->integer('created_by')->references('id')->on('users');
            $table->integer('updated_by')->nullable()->references('id')->on('users');
            $table->integer('deleted_by')->nullable()->references('id')->on('users');
            
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
