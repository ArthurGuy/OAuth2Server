<?php namespace ArthurGuy\OAuth2Server\Repositories;

use ArthurGuy\OAuth2Server\Models\Scope;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Storage\Adapter;
use League\OAuth2\Server\Storage\ScopeInterface;

class ScopeRepository extends Adapter implements ScopeInterface
{
    /**
     * Return information about a scope
     * @param  string $scope The scope
     * @param  string $grantType The grant type used in the request (default = "null")
     * @param  string $clientId The client sending the request (default = "null")
     * @return \League\OAuth2\Server\Entity\ScopeEntity
     */
    public function get($scope, $grantType = null, $clientId = null)
	{
        $scope = Scope::where('id', $scope)->first();

        if (is_null($scope)) {
            return false;
        }
        return (new ScopeEntity($this->server))->hydrate([
                'id'            =>  $scope->id,
                'description'   =>  $scope->description
            ]);
	}

}
