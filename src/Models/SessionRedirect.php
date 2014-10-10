<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionRedirect extends Eloquent
{
    protected $table = 'oauth_session_redirects';

    public $incrementing = false;

	protected $fillable = [
        'session_id',
        'redirect_uri',
	];
}
