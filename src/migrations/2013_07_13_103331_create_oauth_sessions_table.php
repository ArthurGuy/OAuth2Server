<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_sessions', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('client_id', 40);
                $table->enum('owner_type', array('user', 'client'))->default('user');
                $table->string('owner_id', 255);
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
        Schema::drop('oauth_sessions');
    }
}
