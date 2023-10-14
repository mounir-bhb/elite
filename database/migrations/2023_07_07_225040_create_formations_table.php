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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('cycle_id')->nullable();
            $table->integer('filiere_id')->nullable();
            $table->integer('annee_id')->nullable();
            $table->integer('matiere_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('a_apprendre')->nullable();
            $table->longText('prerequis')->nullable();
            $table->longText('a_propos')->nullable();
            $table->boolean('is_valide')->default(false);
            $table->string('photo_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};
