<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeylistsTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keytypes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 50);
            $table->longText('description')->nullable();
            $table->longText('extended_data')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('keytype');
        });

        Schema::create('keyvalues', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('keytype_id')->unsigned();
            $table->string('keyvalue', 255);
            $table->string('keyname', 255);
            $table->longText('description')->nullable();
            $table->longText('extended_data')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['keytype_id', 'keyvalue']);

            $table->foreign('keytype_id')
                ->references('id')->on('keytypes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keyvalues');
        Schema::drop('keytypes');
    }
}
