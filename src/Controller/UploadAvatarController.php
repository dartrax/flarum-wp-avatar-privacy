<?php

namespace Dartrax\FlarumWpAvatarPrivacy\Controller;

use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\Exception\PermissionDeniedException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as Handler;

use Dartrax\FlarumWpAvatarPrivacy\Core;
use Dartrax\FlarumWpAvatarPrivacy\Response\NullResponse;

/**
 * Upload avatar intercept controller.
 */
class UploadAvatarController implements Handler {
	/**
	 * Settings object.
	 *
	 * @var SettingsRepositoryInterface
	 */
	protected /*SettingsRepositoryInterface*/ $settings;

	/**
	 * Upload avatar intercept controller.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 */
	public function __construct(SettingsRepositoryInterface $settings) {
		$this->settings = $settings;
	}

	/**
	 * Request handler.
	 *
	 * @param Request $request Request object.
	 * @return Response Response object.
	 */
	public function handle(Request $request): Response {
		// If upload avatars disabled, do not allow upload.
		if (Core::settingDisableUpload($this->settings)) {
			throw new PermissionDeniedException();
		}

		// Pass through.
		return new NullResponse();
	}
}
