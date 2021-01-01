import app from 'flarum/app';

import {ID} from '../config';
import {intercept} from '../shared/intercept';
import {AvatarPrivacySettingsModal} from './components/AvatarPrivacySettingsModal';

app.initializers.add(ID, () => {
	intercept();

	app.extensionSettings[ID] = () => app.modal.show(AvatarPrivacySettingsModal);
});
