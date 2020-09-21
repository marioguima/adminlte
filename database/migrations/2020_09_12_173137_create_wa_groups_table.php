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
            $table->foreignId('segmentations_id')->constrained();
            $table->string('name', 25);
            $table->string('image_path')->nullable();
            $table->text('description')->nullable();
            $table->enum('edit_data', ['all', 'only_admins'])->comment('Configuração de quem pode editar os dados do grupo.');
            $table->enum('send_message', ['all', 'only_admins'])->comment('Configuração de quem pode enviar mensagem no grupo.');
            $table->integer('seats')->comment('Quantidade máxima de vagas disponíveis no grupo. Contando com os administradores.');
            $table->integer('occuped_seats')->default(0)->comment('Quantidade de pessoas no grupo. Contando com os administradores.');
            $table->integer('people_left')->default(0)->comment('Quantidade de pessoas que saíram do grupo.');
            $table->string('url')->nullable();
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
