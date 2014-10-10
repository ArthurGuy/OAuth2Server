<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Scope extends Eloquent
{
    protected $table = 'oauth_scopes';

    public $timestamps = false;

    protected $primaryKey = 'id';

	protected $fillable = [
        'id',
        'description',
	];
}
