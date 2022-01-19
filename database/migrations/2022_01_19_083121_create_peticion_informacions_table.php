<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeticionInformacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('peticiones_informacion', function (Blueprint $table) {
	    $table->id();
	    $table->bigInteger('tutorGrupo')->nullable();
	    $table->bigInteger('alumno')->nullable();
	    $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('peticiones_informacion');
    }
}
