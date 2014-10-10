<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AccessToken extends Eloquent
{
    protected $table = 'oauth_access_tokens';

	protected $fillable = [
        'session_id',
        'access_token',
        'access_token_expires',
	];


    public function session()
    {
        return $this->belongsTo('ArthurGuy\OAuth2Server\Models\Session');
    }

}
