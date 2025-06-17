export const handleFormSuccess = () => {
	document.addEventListener('wpcf7mailsent', function () {
		const contestForm = document.querySelector('.register-form');

		if (!contestForm) {
			return;
		}

		const image = `<svg width="88" height="88" viewBox="0 0 88 88" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect x="79.3672" y="59.3519" width="21.217" height="21.217" transform="rotate(97.9733 79.3672 59.3519)" fill="#F0CB69"/>
							<path d="M64.7541 17.5C58.9535 11.6343 50.9012 8 42 8C24.3269 8 10 22.3269 10 40C10 57.6731 24.3269 72 42 72C59.6731 72 74 57.6731 74 40C74 33.4786 72.0492 27.4129 68.6994 22.3545" stroke="#181B2B" stroke-width="1.5"/>
							<path d="M28.5 38.9672L38.3077 49L73.5 13" stroke="#181B2B" stroke-width="1.5"/>
						</svg>
						`;

		const imageContainer = document.createElement('div');
		imageContainer.classList.add('register-success-image');
		imageContainer.innerHTML = image;
		const successContainer = document.createElement('div');
		successContainer.classList.add('register-success');

		const successHeading = document.createElement('h2');
		successHeading.textContent = 'Ačiū, kad užsiregistravote!';

		const successText = document.createElement('p');
		successText.textContent =
			'Per 2 darbo dienas susisieksime sutarti apsilankymo laiką.';

		const closeButton = document.createElement('button');

		contestForm.appendChild(imageContainer);
		closeButton.textContent = 'Uždaryti';
		closeButton.classList.add('erd_button');
		closeButton.addEventListener('click', () => {
			successContainer.remove();
		});

		successContainer.appendChild(successHeading);
		successContainer.appendChild(successText);
		successContainer.appendChild(closeButton);

		contestForm.innerHTML = '';
		contestForm.appendChild(successContainer);
	});
};
