<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Post extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('viewnumber')->default('0');
            $table->unsignedBigInteger('id_creator');
            $table->unsignedBigInteger('id_category');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table ->foreign('id_creator')->references('id')->on('users');
            $table ->foreign('id_category')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
