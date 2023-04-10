<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descriptions')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->integer('progress')->nullable();
            $table->enum('label', ['yallow','green', 'red', 'blue'])->default('yallow');
            $table->bigInteger('list_id')->unsigned();
            $table->foreign('list_id')->references('id')->on('lissts')->onDelete('cascade');
            $table->bigInteger('user_assign_id')->unsigned();
            $table->foreign('user_assign_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('cards');
    }
}
