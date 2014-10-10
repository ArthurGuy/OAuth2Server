<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOauthSessionRefreshTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_session_refresh_tokens', function(Blueprint $table)
            {
                $table->integer('session_access_token_id');
                $table->string('refresh_token', 40);
                $table->integer('refresh_token_expires');
                $table->string('client_id', 40);
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
        Schema::drop('oauth_session_refresh_tokens');
    }
}
