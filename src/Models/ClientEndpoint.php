<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ClientEndpoint extends Eloquent
{
    protected $table = 'oauth_client_endpoints';

	protected $fillable = [
        'client_id',
        'redirect_uri',
	];
}
