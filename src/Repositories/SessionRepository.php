<?php namespace ArthurGuy\OAuth2Server\Repositories;

use ArthurGuy\OAuth2Server\Models\AccessToken;
use League\OAuth2\Server\Entity\AccessTokenEntity;
use League\OAuth2\Server\Entity\AuthCodeEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Entity\ScopeEntity;

use ArthurGuy\OAuth2Server\Models\Session;
use ArthurGuy\OAuth2Server\Models\SessionRedirect;
use ArthurGuy\OAuth2Server\Models\SessionAuthcode;
use ArthurGuy\OAuth2Server\Models\SessionTokenScope;
use ArthurGuy\OAuth2Server\Models\SessionAccessToken;
use ArthurGuy\OAuth2Server\Models\SessionRefreshToken;
use ArthurGuy\OAuth2Server\Models\SessionAuthcodeScope;
use League\OAuth2\Server\Storage\Adapter;
use League\OAuth2\Server\Storage\SessionInterface;

class SessionRepository extends Adapter implements SessionInterface
{

    /**
     * Associate a scope with an access token
     *
     * @param SessionEntity $session
     * @param ScopeEntity   $scope
     * @internal param int $accessTokenId The ID of the access token
     * @internal param int $scopeId The ID of the scope
     * @return void
     */
    public function associateScope(SessionEntity $session, ScopeEntity $scope)
    {
        /*
        SessionTokenScope::create([
            'session_access_token_id' => $session->getId(),
            'scope_id'                => $scope->getId(),
        ]);
        */
    }

    /**
     * Get all associated access tokens for an access token
     *
     * @param SessionEntity $session
     * @internal param string $accessToken The access token
     * @return array
     */
    public function getScopes(SessionEntity $session)
    {
        /*
        $scopes = SessionTokenScope::join('oauth_session_access_tokens', 'oauth_session_access_tokens.id', '=', 'oauth_session_token_scopes.session_access_token_id')
            ->join('oauth_scopes', 'oauth_scopes.id', '=', 'oauth_session_token_scopes.scope_id')
            ->select('oauth_scopes.*')
            ->where('oauth_session_access_tokens.access_token', $session->accessToken)
            ->get();
        */
        return [];
    }

    /**
     * Get a session from an access token
     * @param  \League\OAuth2\Server\Entity\AccessTokenEntity $accessToken The access token
     * @return \League\OAuth2\Server\Entity\SessionEntity
     */
    public function getByAccessToken(AccessTokenEntity $accessToken)
    {
        $token = AccessToken::where('id', $accessToken->getId())->first();
        if (is_null($token)) {
            return false;
        }

        return (new SessionEntity($this->server))->hydrate([
                'id'            =>  $token->session->id,
                'client'   =>  $token->session->client_id,
                'owner_id' => $token->session->owner_id,
                'owner_type' => $token->session->owner_type
            ]);
    }

    /**
     * Get a session from an auth code
     * @param  \League\OAuth2\Server\Entity\AuthCodeEntity $authCode The auth code
     * @return \League\OAuth2\Server\Entity\SessionEntity
     */
    public function getByAuthCode(AuthCodeEntity $authCode)
    {
        // TODO: Implement getByAuthCode() method.
    }

    /**
     * Create a new session
     * @param  string $ownerType Session owner's type (user, client)
     * @param  string $ownerId Session owner's ID
     * @param  string $clientId Client ID
     * @param  string $clientRedirectUri Client redirect URI (default = null)
     * @return integer The session's ID
     */
    public function create($ownerType, $ownerId, $clientId, $clientRedirectUri = null)
    {
        $session = Session::create([
                'client_id'  => $clientId,
                'owner_type' => $ownerType,
                'owner_id'   => $ownerId,
            ]);

        return $session->id;
    }
}
