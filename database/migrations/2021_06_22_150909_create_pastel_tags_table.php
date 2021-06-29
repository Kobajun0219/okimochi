<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePastelTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pastel_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pastel_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            //外部キー参照
            $table->foreign('pastel_id')
                ->references('id')
                ->on('pastels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastel_tags');
    }
}
