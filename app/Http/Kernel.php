<?php namespace sccbakery\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'sccbakery\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
        'admin_auth'    => 'sccbakery\Admin\Middleware\Authenticate',

		'auth'          => 'sccbakery\Http\Middleware\Authenticate',
		'auth.basic'    => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest'         => 'sccbakery\Http\Middleware\RedirectIfAuthenticated',
	];

}
