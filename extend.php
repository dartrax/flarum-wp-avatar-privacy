<?php

use Flarum\Extend;

use Dartrax\FlarumWpAvatarPrivacy\Extenders;
use Dartrax\FlarumWpAvatarPrivacy\Listener;
use Dartrax\FlarumWpAvatarPrivacy\Middleware;

return [
	// Client-side code.
	(new Extend\Frontend('forum'))
		->js(__DIR__.'/js/dist/forum.js')
		->content(Listener\AddData::class),
	(new Extend\Frontend('admin'))
		->js(__DIR__.'/js/dist/admin.js')
		->content(Listener\AddData::class),

	// Middleware.
	(new Extend\Middleware('api'))
		->add(Middleware\InterceptApi::class),

	// Extenders.
	new Extenders\BasicUserSerializing()
];
