<?php namespace ArthurGuy\OAuth2Server\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AccessTokenScope extends Eloquent
{
    protected $table = 'oauth_access_token_scopes';

	protected $fillable = [
        'access_token',
        'scope_id',
	];

    public $timestamps = false;

    public function scope()
    {
        return $this->belongsTo('ArthurGuy\OAuth2Server\Models\Scope');
    }

    public function accessToken()
    {
        return $this->belongsTo('ArthurGuy\OAuth2Server\Models\AccessToken');
    }

}
