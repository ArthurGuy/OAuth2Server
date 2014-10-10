<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionTokenScope extends Eloquent
{
    protected $table = 'oauth_session_token_scopes';

	protected $fillable = [
        'session_access_token_id',
        'scope_id',
	];
}
