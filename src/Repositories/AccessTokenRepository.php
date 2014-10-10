<?php namespace ArthurGuy\OAuth2Server\Repositories;

use ArthurGuy\OAuth2Server\Models\AccessToken;
use ArthurGuy\OAuth2Server\Models\AccessTokenScope;
use ArthurGuy\OAuth2Server\Models\SessionTokenScope;
use League\OAuth2\Server\Entity\AbstractTokenEntity;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\ScopeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\AccessTokenInterface;
use League\OAuth2\Server\Storage\Adapter;
use League\OAuth2\Server\Storage\League;

class AccessTokenRepository extends Adapter implements AccessTokenInterface {


    /**
     * Get an instance of Entity\AccessTokenEntity
     * @param  string $token The access token
     * @return \League\OAuth2\Server\Entity\AccessTokenEntity
     */
    public function get($token)
    {
        $result = AccessToken::where('access_token', $token)->where('access_token_expires', '>=', time())->first();

        if (is_null($result)) {
            return false;
        }

        $session = (new SessionEntity($this->server))->setId($result->session_id)->setOwner($result->session->owner_type, $result->session->owner_id);
        return (new AccessTokenEntity($this->server))
            ->setId($result->access_token)
            ->setExpireTime($result->expire_time)
            ->setSession($session);
    }

    /**
     * Get the scopes for an access token
     * @param  \League\OAuth2\Server\Entity\AbstractTokenEntity $token The access token
     * @return array                                            Array of \League\OAuth2\Server\Entity\ScopeEntity
     */
    public function getScopes(AbstractTokenEntity $token)
    {
        $tokenScopes = AccessTokenScope::with('scope')->where('access_token', $token->getId())->get();

        $response = [];
        if ($tokenScopes) {
            foreach ($tokenScopes as $tokenScope) {
                $scope = (new ScopeEntity($this->server))->hydrate([
                        'id'          => $tokenScope->scope->id,
                        'description' => $tokenScope->scope->description
                    ]);
                $response[] = $scope;
            }
        }

        return $response;
    }

    /**
     * Creates a new access token
     * @param  string         $token The access token
     * @param  integer        $expireTime The expire time expressed as a unix timestamp
     * @param  string|integer $sessionId The session ID
     * @return \League\OAuth2\Server\Entity\AbstractTokenEntity
     */
    public function create($token, $expireTime, $sessionId)
    {
        $resource = AccessToken::create([
                'access_token' => $token,
                'access_token_expires' => $expireTime,
                'session_id' => $sessionId
            ]);
        return (new AccessTokenEntity($this->server))
            ->setId($resource->access_token)
            ->setExpireTime($resource->expire_time);

    }

    /**
     * Associate a scope with an acess token
     * @param  \League\OAuth2\Server\Entity\AbstractTokenEntity $token The access token
     * @param  \League\OAuth2\Server\Entity\ScopeEntity         $scope The scope
     * @return void
     */
    public function associateScope(AbstractTokenEntity $token, ScopeEntity $scope)
    {
        AccessTokenScope::create([
                'access_token'  =>  $token->getId(),
                'scope_id' =>  $scope->getId()
            ]);
    }

    /**
     * Delete an access token
     * @param  \League\OAuth2\Server\Entity\AbstractTokenEntity $token The access token to delete
     * @return void
     */
    public function delete(AbstractTokenEntity $token)
    {
        AccessToken::where('access_token', $token->getId())->delete();
    }
}