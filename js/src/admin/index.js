import app from 'flarum/app';

import {ID} from '../config';
import {intercept} from '../shared/intercept';

app.initializers.add(ID, app => {
	intercept();

	const ext = app.extensionData.for(ID);

	const field = (type, key, name, help = null) => {
		ext.registerSetting({
			setting: `${ID}.${key}`,
			label: name,
			help: help,
			type: type
		});
	};

	field('text', 'cache_dir', 'Avatar Privacy Cache Directory', 'Absolute path to the cached avatars of your Avatar Privacy Plugin for Wordpress. Example: http://localhost/wp-content/uploads/avatar-privacy/cache/identicon');
	field('text', 'extension', 'Avatars file extension', 'With leading dot. Default: .svg');
	field('text', 'salt', 'Avatar Privacy Salt', 'Paste the value of avatar_privacy_salt from your Wordpress Options Table');
	field('boolean', 'disable_upload', 'Disable Avatar Upload', 'Don\'t let users override their chached Avatar Privacy avatar with an individual one via their profile page');
});
