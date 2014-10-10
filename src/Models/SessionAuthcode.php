<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionAuthcode extends Eloquent
{
    protected $table = 'oauth_session_authcodes';

	protected $fillable = [
        'session_id',
        'auth_code',
        'auth_code_expires',
	];
}
