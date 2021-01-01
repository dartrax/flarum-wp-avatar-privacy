<?php

namespace Dartrax\FlarumWpAvatarPrivacy;

use Flarum\Frontend\Document;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\User;

/**
 * Core functionality.
 */
class Core {
	/**
	 * Extension identifier.
	 *
	 * @var string
	 */
	public const ID = 'dartrax-wp-avatar-privacy';

	/**
	 * If an empty string, return null, else return the string.
	 *
	 * @param string|null $str String value.
	 * @return string|null The string or null.
	 */
	public static function emptyStringNull(?string $str) {
		return $str === '' ? null : $str;
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @param string $key Setting key.
	 * @return string|null Setting value.
	 */
	public static function setting(
		SettingsRepositoryInterface $settings,
		string $key
	): ?string {
		return $settings->get(static::ID . '.' . $key);
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @return string Setting value.
	 */
	public static function settingCacheDir(
		SettingsRepositoryInterface $settings
	): string {
		return static::setting($settings, 'cache_dir') ?? '';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @return string Setting value.
	 */
	public static function settingExtension(
		SettingsRepositoryInterface $settings
	): string {
		return static::setting($settings, 'extension') ?? '';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @return string Setting value.
	 */
	public static function settingSalt(
		SettingsRepositoryInterface $settings
	): string {
		return static::setting($settings, 'salt') ?? '';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @return string|null Setting value.
	 */
	public static function settingDisableUpload(
		SettingsRepositoryInterface $settings
	): bool {
		return (bool)static::setting($settings, 'disable_upload');
	}

	/**
	 * Get the Avatar Privacy cached avatar URL for an email address.
	 *
	 * @param string $email Email address.
	 * @param array|null $opts Optional options.
	 * @return string|Null Avatar Privacy cached avatar URL.
	 */
	public static function apAvatarUrl(string $email, string $salt, string $cachedir, string $extension): ?string {
		// Create hash the same way avatar privacy does
		$hash = hash('sha256', $salt . strtolower(trim($email)));
		if (strlen($hash) < 3) return '';
		// build URL the same way avatar privacy does
        return $cachedir . '/' . $hash[0] . '/' . $hash[1] . '/' . $hash . $extension;
	}

	/**
	 * Get avatar URL for user, or keep existing.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 * @param User $user User object.
	 * @param string|null $existing Existing URL.
	 * @return string|null Avatar URL.
	 */
	public static function userAvatarUrl(
		SettingsRepositoryInterface $settings,
		User $user,
		?string $existing = null
	): ?string {
		// If an existing avatar and upload not disabled, use that.
		if ($existing && !static::settingDisableUpload($settings)) {
			return $existing;
		}
		// Create the Avatar Privacy cached avatar URL.
		return static::apAvatarUrl($user->email, static::settingSalt($settings), static::settingCacheDir($settings), static::settingExtension($settings));
	}

	/**
	 * Add payload to document.
	 *
	 * @param Document $view Document view.
	 * @param SettingsRepositoryInterface $settings Settings object.
	 */
	public static function addPayload(
		Document $view,
		SettingsRepositoryInterface $settings
	): void {
		$view->payload[static::ID] = [
			'disableUpload' => static::settingDisableUpload($settings),
			'cacheDir' => static::settingCacheDir($settings)
		];
	}
}
