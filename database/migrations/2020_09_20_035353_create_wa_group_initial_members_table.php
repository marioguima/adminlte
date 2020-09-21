<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaGroupInitialMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wa_group_initial_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wa_groups_id')->constrained()->onDelete('cascade');
            $table->string('contact_name');
            $table->boolean('administrator');
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
        Schema::dropIfExists('wa_group_initial_members');
    }
}
