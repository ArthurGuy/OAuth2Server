<?php namespace ArthurGuy\OAuth2Server\Repositories;

use ArthurGuy\OAuth2Server\Models\Client;
use ArthurGuy\OAuth2Server\Models\Session;
use League\OAuth2\Server\Entity\ClientEntity;
use League\OAuth2\Server\Entity\SessionEntity;
use League\OAuth2\Server\Storage\Adapter;
use League\OAuth2\Server\Storage\ClientInterface;
use League\OAuth2\Server\Storage\League;

class ClientRepository extends Adapter implements ClientInterface
{
    /**
     * Validate a client
     *
     * @param  string     $clientId     The client's ID
     * @param  string     $clientSecret The client's secret (default = "null")
     * @param  string     $redirectUri  The client's redirect URI (default = "null")
     * @param  string     $grantType    The grant type used in the request (default = "null")
     * @return bool|array               Returns false if the validation fails, array on success
     */
    public function get($clientId, $clientSecret = null, $redirectUri = null, $grantType = null)
    {
        if (!is_null($redirectUri) && is_null($clientSecret)) {
            $client = Client::join('oauth_client_endpoints', 'oauth_client_endpoints.client_id', '=', 'oauth_clients.id')
                ->select('oauth_clients.id', 'oauth_clients.secret', 'oauth_client_endpoints.redirect_uri', 'oauth_clients.name')
                ->where('oauth_clients.id', $clientId)
                ->where('oauth_client_endpoints.redirect_uri', $redirectUri)
                ->first();
        }
        elseif (!is_null($clientSecret) && is_null($redirectUri)) {
            $client = Client::select('id', 'secret', 'name')
                ->where('id', $clientId)
                ->where('secret', $clientSecret)
                ->first();
        }
        elseif ( ! is_null($clientSecret) && ! is_null($redirectUri)) {
            $client = Client::join('oauth_client_endpoints', 'oauth_client_endpoints.client_id', '=', 'oauth_clients.id')
                ->select('oauth_clients.id', 'oauth_clients.secret', 'oauth_client_endpoints.redirect_uri', 'oauth_clients.name')
                ->where('oauth_clients.id', $clientId)
                ->where('oauth_clients.secret', $clientSecret)
                ->where('oauth_client_endpoints.redirect_uri', $redirectUri)
                ->first();
        }

        if (is_null($client)) {
            return false;
        }

        if(!isset($client->redirect_uri)) {
            $client->redirect_uri = null;
        }

        $clientEntity = new ClientEntity($this->server);
        $clientEntity->hydrate([
                'id'    =>  $client->id,
                'name'  =>  $client->name
            ]);

        return $clientEntity;

    }


    /**
     * Get the client associated with a session
     * @param  \League\OAuth2\Server\Entity\SessionEntity $session The session
     * @return \League\OAuth2\Server\Entity\ClientEntity
     */
    public function getBySession(SessionEntity $session)
    {
        //dd($session);
        $session = Session::with('Client')->where('id', $session->getId())->first();
        //dd($session);
        if (is_null($session)) {
            return false;
        }

        $client = $session->client;

        $clientEntity = new ClientEntity($this->server);
        $clientEntity->hydrate([
                'id'    =>  $client->id,
                'name'  =>  $client->name
            ]);

        return $clientEntity;
    }
}
