<?php namespace ArthurGuy\OAuth2Server;

use Illuminate\Support\ServiceProvider;

class OAuth2ServerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('arthurguy/oauth2server');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind(
            'League\\OAuth2\\Server\\Storage\\ClientInterface',
            'ArthurGuy\\OAuth2Server\\Repositories\\ClientRepository'
        );

        $this->app->bind(
            'League\\OAuth2\\Server\\Storage\\ScopeInterface',
            'ArthurGuy\\OAuth2Server\\Repositories\\ScopeRepository'
        );

        $this->app->bind(
            'League\\OAuth2\\Server\\Storage\\SessionInterface',
            'ArthurGuy\\OAuth2Server\\Repositories\\SessionRepository'
        );

        $this->app->bind(
            'League\\OAuth2\\Server\\Storage\\AccessTokenInterface',
            'ArthurGuy\\OAuth2Server\\Repositories\\AccessTokenRepository'
        );
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
