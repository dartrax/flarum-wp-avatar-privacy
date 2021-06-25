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
	 * Largest usage is 96, use 2x for higher DPX screens.
	 *
	 * @var int
	 */
	public const SIZE_LARGEST_2X = (96 * 2);

	/**
	 * Settings object.
	 *
	 * @var SettingsRepositoryInterface
	 */
	protected /*SettingsRepositoryInterface*/ $settings;

	/**
	 * Core functionality.
	 *
	 * @param SettingsRepositoryInterface $settings Settings object.
	 */
	public function __construct(SettingsRepositoryInterface $settings) {
		$this->settings = $settings;
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @param string $key Setting key.
	 * @return string|null Setting value.
	 */
	public function setting(string $key): ?string {
		return $this->settings->get(static::ID . '.' . $key);
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @return string Setting value.
	 */
	public function settingSalt(): string {
		return $this->setting('salt') ?? '';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @return string Setting value.
	 */
	public function settingCacheDir(): string {
		return $this->setting('cache_dir') ?? '';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @return string Setting value.
	 */
	public function settingExtension(): string {
		return $this->setting('extension') ?? '.svg';
	}

	/**
	 * Get setting value for this extension.
	 *
	 * @return string|null Setting value.
	 */
	public function settingDisableUpload(): bool {
		return (bool)$this->setting('disable_upload');
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
	 * Get avatar URL for email, or keep existing.
	 *
	 * @param string $email The email.
	 * @param string|null $existing Existing URL.
	 * @return string|null Avatar URL.
	 */
	public function avatarUrl(
		string $email,
		?string $existing = null
	): ?string {
		// If an existing avatar and upload not disabled, use that.
		if ($existing && !$this->settingDisableUpload()) return $existing;
		// Create the Avatar Privacy cached avatar URL.
		return static::apAvatarUrl($email, $this->settingSalt(), $this->settingCacheDir(), $this->settingExtension());
	}

	/**
	 * Add payload to document.
	 *
	 * @param Document $view Document view.
	 */
	public function addPayload(Document $view): void {
		$view->payload[static::ID] = [
			'disableUpload' => $this->settingDisableUpload(),
			'cacheDir' => $this->settingCacheDir()
		];
	}

	/**
	 * If an empty string, return null, else return the value.
	 *
	 * @param mixed $str The value.
	 * @return string|null The string or null.
	 */
	public static function emptyStringNull($value) {
		return $value === '' ? null : $value;
	}
}
