<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentationGroupsHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segmentation_groups_hits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segmentations_id')->constrained()->onDelete('cascade');
            $table->foreignId('wa_groups_id')->constrained()->onDelete('cascade');
            $table->string('ip')->default('127.0.0.0')->Comment('Ex. 189.54.222.185');
            $table->string('iso_code')->default('XXX')->Comment('Ex. BR');
            $table->string('country')->default('Indefinido')->Comment('Ex. Brazil');
            $table->string('city')->default('Indefinida')->Comment('Ex. São Bernardo do Campo');
            $table->string('state')->default('XX')->Comment('Ex. SP');
            $table->string('state_name')->default('Indefinida')->Comment('Ex. Sao Paulo');
            $table->string('postal_code')->default('00000')->Comment('Ex. 09920');
            $table->string('timezone')->default('Indefinida/Indefinida')->Comment('Ex. America/Sao_Paulo');
            $table->string('continent')->default('XX')->Comment('Ex. SA');
            $table->string('currency')->default('XXX')->Comment('Ex. BRL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segmentation_groups_hits');
    }
}
