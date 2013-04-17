<?php

use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function($table) {
            $table->increments('id')->unsigned();
            $table->string('title', 60);
            $table->text('description');
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
        Schema::drop('todos');
    }

}
