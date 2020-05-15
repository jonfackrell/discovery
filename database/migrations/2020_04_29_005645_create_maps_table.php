<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('library')->nullable();
            $table->string('collection')->nullable();
            $table->string('location')->nullable();
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('range_start')->nullable();
            $table->string('range_end')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('description')->nullable();
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
        Schema::drop('maps');
    }
}
