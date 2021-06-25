<?php

namespace Dartrax\FlarumWpAvatarPrivacy\Provider;

use Flarum\Foundation\AbstractServiceProvider;

use Dartrax\FlarumWpAvatarPrivacy\Core;

/**
 * CoreProvider functionality.
 */
class CoreProvider extends AbstractServiceProvider {
	/**
	 * Register method.
	 */
	public function register() {
		$this->container->singleton(Core::class);
	}
}
