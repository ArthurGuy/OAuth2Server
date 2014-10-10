<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Client extends Eloquent
{
    protected $table = 'oauth_clients';

    public $incrementing = false;

	protected $fillable = [
        'secret',
        'name',
        'auto_approve',
	];

}
