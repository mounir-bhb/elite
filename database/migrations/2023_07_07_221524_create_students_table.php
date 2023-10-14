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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            /* $table->integer('user_id')->nullable(); */
            $table->integer('cycle_id');
            $table->integer('filiere_id')->nullable();
            $table->integer('annee_id')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('tel');
            $table->date('date_naissance');
            $table->enum('sex',['Homme','Femme']);
            /* $table->text('description'); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
