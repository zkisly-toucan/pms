<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSecrets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function(Blueprint $table){
            $table->integer('id')->index();
            $table->string('name');
        });

        Schema::create('groups', function(Blueprint $table){
            $table->integer('id')->index();
            $table->integer('owner_id');
            $table->integer('level')->default(10);
            $table->boolean('private')->default(true);
            $table->string('name');
        });

        Schema::create('secrets', function(Blueprint $table){
            $table->integer('id')->index();
            $table->integer('group_id');
            $table->integer('type_id');
            $table->string('name');
            $table->mediumText('value');
        });

        Schema::create('requests', function(Blueprint $table){
            $table->integer('id')->index();
            $table->integer('group_id');
            $table->integer('user_id');
            $table->integer('status');
        });

        Schema::create('accesses', function(Blueprint $table){
            $table->integer('id')->index();
            $table->integer('group_id');
            $table->integer('user_id');
            $table->boolean('edit');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('secrets');
        Schema::dropIfExists('requests');
        Schema::dropIfExists('accesses');
    }
}
