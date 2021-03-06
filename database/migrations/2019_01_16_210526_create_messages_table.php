<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->unsignedInteger('receiver');
            $table->unsignedInteger('sender');
            $table->text('message');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            // $table->foreign('conversation_id')->references('id')->on('conversation');
            // $table->foreign('sender')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
