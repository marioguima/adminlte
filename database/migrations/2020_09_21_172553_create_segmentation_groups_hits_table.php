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
            $table->foreignId('segmentations_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('wa_groups_id')
                ->comment('Caso não tenha vaga disponível em nenhum grupo só terá hit na segmentação')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
            $table->string('ip')
                ->comment('Ex. 189.54.222.185')
                ->default('127.0.0.0');
            $table->string('iso_code')
                ->comment('Ex. BR')
                ->default('XXX');
            $table->string('country')
                ->comment('Ex. Brazil')
                ->default('Indefinido');
            $table->string('city')
                ->comment('Ex. São Bernardo do Campo')
                ->default('Indefinida');
            $table->string('state')
                ->comment('Ex. SP')
                ->default('XX');
            $table->string('state_name')
                ->comment('Ex. Sao Paulo')
                ->default('Indefinida');
            $table->string('postal_code')
                ->comment('Ex. 09920')
                ->default('00000');
            $table->string('timezone')
                ->comment('Ex. America/Sao_Paulo')
                ->default('Indefinida/Indefinida');
            $table->string('continent')
                ->comment('Ex. SA')
                ->default('XX');
            $table->string('currency')
                ->comment('Ex. BRL')
                ->default('XXX');
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
