<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_messages', function (Blueprint $table) {
            $table->foreignId('campaigns_id')->constrained();
            $table->foreignId('messages_id')->constrained();
            $table->enum('shot', ['immediate', 'date', 'relative']);
            $table->dateTime('scheduler_date');
            $table->integer('quantity');
            $table->enum('unit', ['minutes', 'hours', 'days']);
            $table->enum('trigger', ['before', 'after']);
            $table->enum('momment', ['start_campaign', 'end_campaign', 'start_monitoring', 'end_monitoring']);
            $table->timestamps();
            // Index
            $table->index(['campaigns_id', 'messages_id']);
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
