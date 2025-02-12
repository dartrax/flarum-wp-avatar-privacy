<?php

use Flarum\Extend;

use Dartrax\FlarumWpAvatarPrivacy\Extenders;
use Dartrax\FlarumWpAvatarPrivacy\Listener;
use Dartrax\FlarumWpAvatarPrivacy\Provider;

return [
	// Register core class as a service (a singleton).
	(new Extend\ServiceProvider())
		->register(Provider\CoreProvider::class),

	// Client-side code.
	(new Extend\Frontend('forum'))
		->js(__DIR__ . '/js/dist/forum.js')
		->content(Listener\AddData::class),
	(new Extend\Frontend('admin'))
		->js(__DIR__ . '/js/dist/admin.js')
		->content(Listener\AddData::class),

	// Extenders.
	new Extenders\BasicUserSerializing(),
	new Extenders\RoutesApi()
];
