<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SessionAuthcodeScope extends Eloquent
{
    protected $table = 'oauth_session_authcode_scopes';

    public $incrementing = false;

	protected $fillable = [
        'oauth_session_authcode_id',
        'scope_id',
	];
}
