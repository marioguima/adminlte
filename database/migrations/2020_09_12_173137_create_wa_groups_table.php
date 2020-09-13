<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wa_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('segmentations_id')->constrained('segmentations');
            $table->string('name', 25);
            $table->string('url');
            $table->text('description')->nullable();
            $table->integer('seats')->comment('Máximo de lugares disponíveis no grupo. Contando com os administradores.');
            $table->integer('occuped_seats')->comment('Lugares ocupados no grupo. Contando com os administradores.');
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
        Schema::dropIfExists('wa_groups');
    }
}
