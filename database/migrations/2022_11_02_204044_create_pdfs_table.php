<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdfs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personne_id');
            $table->string('nomAr');
            $table->string('prenomAr');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('grade');
            $table->string('lieuResidence');
            $table->string('lieuConge');
            $table->integer('annee');
            $table->string('tele');
            $table->integer('periode');
            $table->integer('valeur');
            $table->integer('duree');
            $table->timestamps();
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdfs');
    }
};
