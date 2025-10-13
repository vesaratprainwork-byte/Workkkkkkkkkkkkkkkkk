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
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->text('synopsis')->nullable(); 
            $table->integer('release_year')->nullable();
            $table->string('poster_url')->nullable(); 
            
           
            $table->string('genre_code');
            $table->foreign('genre_code')->references('code')->on('genres');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
