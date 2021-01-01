import SettingsModal from 'flarum/components/SettingsModal';

import {ID} from '../../config';

export class AvatarPrivacySettingsModal extends SettingsModal {
	className() {
		return 'AvatarPrivacySettingsModal Modal';
	}

	title() {
		return 'Avatar Privacy Settings';
	}

	form() {
		const setting = key => this.setting(`${ID}.${key}`);
		return [
			<div className="Form-group">
				<label>Avatar Privacy Cache Directory (Example: <code>http://localhost/wp-content/uploads/avatar-privacy/cache/identicon</code>)</label>
				<code><input className="FormControl" bidi={setting('cache_dir')}/></code>
			</div>
			,
			<div className="Form-group">
				<label>Avatars file extension (Example: <code>.svg</code>)</label>
				<code><input className="FormControl" bidi={setting('extension')}/></code>
			</div>
			,
			<div className="Form-group">
				<label>Avatar Privacy Salt (Paste Value of <code>avatar_privacy_salt</code> in Wordpress Options Table)</label>
				<code><input className="FormControl" bidi={setting('salt')}/></code>
			</div>
			,
			<div className="Form-group">
				<label className="checkbox">
					<input type="checkbox" bidi={setting('disable_upload')}/>
					Disable Avatar Upload
				</label>
			</div>
		];
	}
}
