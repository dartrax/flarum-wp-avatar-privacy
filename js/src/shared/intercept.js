import {matches} from './dom';
import {data} from './util';

function updateAvatarEditors() {
	const {disableUpload} = data();
	const {cacheDir} = data();
	const editors = document.querySelectorAll('.AvatarEditor');
	for (let i = editors.length; i--;) {
		const editor = editors[i];
		const avatar = editor.querySelector('.Avatar');
		const upload = editor.querySelector('.item-upload button');
		const remove = editor.querySelector('.item-remove button');
		const wpapAvatar = avatar && avatar.src.includes(cacheDir);

		// Disable remove for Avatar Privacy avatars.
		if (remove && wpapAvatar) {
			remove.classList.add('disabled');
			remove.setAttribute('disabled','');
		}

		// Disable upload if local avatars disabled.
		if (upload && disableUpload) {
			upload.classList.add('disabled');
			upload.setAttribute('disabled','');
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
