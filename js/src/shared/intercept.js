import {matches} from './dom';
import {data} from './util';

function updateAvatarEditors() {
	const {disableUpload} = data();
	const {cacheDir} = data();
	const divEditors = document.querySelectorAll('.AvatarEditor');
	for (let i = divEditors.length; i--;) {
		const divEditor = divEditors[i];
		const imgAvatar = divEditor.querySelector('.Avatar');
		const btnUpload = divEditor.querySelector('.item-upload button');
		const btnRemove = divEditor.querySelector('.item-remove button');
		const isUploadedAvatar = !(imgAvatar && imgAvatar.src.includes(cacheDir));

		// Enable remove for custom avatars or disable again.
		if (btnRemove) {
			if (isUploadedAvatar) {
				btnRemove.classList.remove('disabled');
				btnRemove.removeAttribute('disabled','');
			} else {
				btnRemove.classList.add('disabled');
				btnRemove.setAttribute('disabled','');
			}
		}
		
		// Disable upload if custom avatars disabled.
		if (btnUpload && disableUpload) {
			btnUpload.classList.add('disabled');
			btnUpload.setAttribute('disabled','');
		}
		// Note: We don't remove items to avoid fixing a potentially empty menu.
	}
}

function clickHandler(e) {
	const {target} = e;

	// If click to open menu, update the editors.
	if (
		matches(target, '.AvatarEditor .Dropdown-toggle') ||
		matches(target, '.AvatarEditor .Dropdown-toggle *')
	) {
		updateAvatarEditors();		
	}
}

export function intercept() {
	window.addEventListener('click', clickHandler, true);
}
