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
        Schema::create('forum_sujets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('cycle_id')->nullable();
            $table->integer('filiere_id')->nullable();
            $table->integer('annee_id')->nullable();
            $table->integer('matiere_id')->nullable();
            $table->string('titre')->nullable();
            $table->text('question');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forum_sujets');
    }
};
