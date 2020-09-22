<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start')->comment('Início da campanha');
            $table->dateTime('end')->comment('Fim da campanha');
            $table->dateTime('start_monitoring')->comment('Início do monitoramento dos grupos da campanha');
            $table->dateTime('stop_monitoring')->comment('Fim do monitoramento dos grupos da campanha');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('campaigns');
    }
}
