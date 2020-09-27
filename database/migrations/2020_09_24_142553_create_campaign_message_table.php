<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_message', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->foreignId('message_id')->constrained();
            $table->enum('shot', ['immediate', 'date', 'relative']);
            $table->dateTime('scheduler_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->enum('unit', ['minutes', 'hours', 'days'])->nullable();
            $table->enum('trigger', ['before', 'after'])->nullable();
            $table->enum('moment', ['start_campaign', 'end_campaign', 'start_monitoring', 'stop_monitoring'])->nullable();
            $table->timestamps();
            // Index
            $table->index(['campaign_id', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_messages');
    }
}
