<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Session extends Eloquent
{
    protected $table = 'oauth_sessions';

	protected $fillable = [
        'client_id',
        'owner_type',
        'owner_id',
	];

    public function client()
    {
        return $this->belongsTo('ArthurGuy\OAuth2Server\Models\Client');
    }
}
