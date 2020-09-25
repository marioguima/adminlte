<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('messages_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['text', 'image', 'document', 'video', 'audio', 'contact']);
            $table->text('value');
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
        Schema::dropIfExists('message_items');
    }
}
