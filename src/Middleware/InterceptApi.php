<?php

namespace Dartrax\FlarumWpAvatarPrivacy\Middleware;

use Flarum\Http\RouteCollection;

use Dartrax\FlarumWpAvatarPrivacy\Controller;

/**
 * InterceptApi middleware.
 */
class InterceptApi extends Intercept {
	/**
	 * Setup routes.
	 *
	 * @param RouteCollection $routes Routes collection.
	 */
	protected function routes(RouteCollection $routes): void {
		$routes->post(
			'/users/{id}/avatar',
			'users.avatar.upload',
			$this->route->toController(
				Controller\UploadAvatarController::class
			)
		);
	}
}
