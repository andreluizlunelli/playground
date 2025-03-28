<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->integer('mal_id');
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('source')->nullable();
            $table->string('status')->nullable();
            $table->integer('episodes')->nullable();
            $table->string('duration')->nullable();
            $table->string('rating')->nullable();
            $table->float('score')->nullable();
            $table->integer('popularity')->nullable();
            $table->dateTimeTz('aired_from')->nullable();
            $table->dateTimeTz('aired_to')->nullable();
            $table->mediumInteger('aired_year')->nullable();
            $table->text('synopsis')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
