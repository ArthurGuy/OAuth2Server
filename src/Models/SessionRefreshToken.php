<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionRefreshToken extends Eloquent
{
    protected $table = 'oauth_session_refresh_tokens';

    public $incrementing = false;

	protected $fillable = [
        'session_access_token_id',
        'refresh_token',
        'refresh_token_expires',
        'client_id',
	];
}
