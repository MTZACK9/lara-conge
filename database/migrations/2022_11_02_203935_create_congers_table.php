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
        Schema::create('congers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personne_id');
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('lieuResidence');
            $table->string('lieuConge');
            $table->string('tele');
            $table->string('annee');
            $table->integer('periode');
            $table->integer('valeur');
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
        Schema::dropIfExists('congers');
    }
};
