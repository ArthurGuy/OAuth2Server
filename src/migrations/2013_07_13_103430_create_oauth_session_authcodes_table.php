<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthSessionAuthcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_session_authcodes', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('session_id');
                $table->string('auth_code', 40);
                $table->integer('auth_code_expires');
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
        Schema::drop('oauth_session_authcodes');
    }
}
