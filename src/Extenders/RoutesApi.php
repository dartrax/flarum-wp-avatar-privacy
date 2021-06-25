<?php

namespace Dartrax\FlarumWpAvatarPrivacy\Extenders;

use Flarum\Extend\Routes;
use Flarum\Extension\Extension;
use Illuminate\Contracts\Container\Container;

use Dartrax\FlarumWpAvatarPrivacy\Core;

/**
 * RoutesApi class.
 */
class RoutesApi extends Routes {
	/**
	 * RoutesApi class.
	 */
	public function __construct() {
		parent::__construct('api');
	}

	/**
	 * Extend method.
	 *
	 * @param Container $container Container object.
	 * @param Extension|null $extension Extension object.
	 */
	public function extend(Container $container, Extension $extension = null) {
		$core = $container->make(Core::class);

		// If local avatars disabled, do not allow upload.
		if ($core->settingDisableUpload()) {
			$this->remove('users.avatar.upload');
		}

		return parent::extend($container, $extension);
	}
}
