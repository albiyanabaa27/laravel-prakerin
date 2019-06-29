<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_tag');
            $table->string('slug')->unique()->index();
            $table->timestamps();
        });

        Schema::create('artikel_tags', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_artikel');
            $table->foreign('id_artikel')->references('id')->on('artikels')->onDelete('cascade');

            $table->unsignedInteger('id_tag');
            $table->foreign('id_tag')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('tags');
    }
}
