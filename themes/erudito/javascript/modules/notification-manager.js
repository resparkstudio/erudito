/**
 * ERD Notification Manager
 * A centralized system for handling notifications across the site
 */
class ERDNotificationManager {
	constructor() {
		// Initialize properties
		this.container = document.querySelector(
			'[data-notifications="container"]'
		);
		this.queue = [];
		this.isProcessing = false;
		this.maxVisible = 3; // Maximum number of visible notifications
		this.visibleCount = 0;

		// Get messages from localized data
		this.messages = window.erdAjaxData?.messages || {};
		console.log(this.messages);

		// Set up event listeners
		this.setupEventListeners();
	}

	/**
	 * Set up WooCommerce event listeners
	 */
	setupEventListeners() {
		jQuery('body').on('added_to_cart', () => {
			this.show(this.messages.added_to_cart, 'success');
		});

		// You can add more event listeners here
	}

	/**
	 * Show a notification
	 * @param {string} message - The message to display
	 * @param {string} type - The type of notification ('success', 'error')
	 * @param {number} duration - How long to show the notification in ms
	 */
	show(message, type = 'success', duration = 3000) {
		// Add to queue
		this.queue.push({ message, type, duration });

		// Process queue if not already processing
		if (!this.isProcessing) {
			this.processQueue();
		}
	}

	/**
	 * Process the notification queue
	 */
	processQueue() {
		// If queue is empty or at max visible notifications, stop
		if (this.queue.length === 0 || this.visibleCount >= this.maxVisible) {
			this.isProcessing = false;
			return;
		}

		// Set processing flag
		this.isProcessing = true;

		// Get the next notification
		const { message, type, duration } = this.queue.shift();

		// Create notification element
		const notification = document.createElement('div');
		notification.className = `py-2.5 rounded-lg flex items-center pointer-events-auto opacity-0 transform translate-y-[-20px] transition-all duration-300`;

		switch (type) {
			case 'success':
				// Set classes and content
				notification.classList.add(
					'bg-green',
					'text-green2',
					'pl-4',
					'pr-3',
					'max-w-[353]',
					'lg:max-w-[600]'
				);
				notification.innerHTML = `
            <div class="mr-2"><svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.729 8.15004L5.97917 11.0001L13.1043 5" stroke="currentColor"/>
</svg>
</div>
            <span class="text-body-s-medium">${message}</span>
        `;
				break;

			case 'error':
				// Set classes and content
				notification.classList.add(
					'bg-red',
					'text-red2',
					'pl-4',
					'pr-3'
				);
				notification.innerHTML = `
				<span class="text-body-s-medium">${message}</span>
            <button class="ml-6 cursor-pointer"><svg class="w-4 h-4" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.66683 12.3333L12.3335 3.66663" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="square"/>
<path d="M12.3334 12.3333L3.66675 3.66663" stroke="currentColor" stroke-miterlimit="10" stroke-linecap="square"/>
</svg>

</button>
        `;
				const closeBtn = notification.querySelector('button');
				closeBtn.addEventListener('click', () =>
					this.removeNotification(notification)
				);
				break;
		}

		// Add to container
		this.container.prepend(notification);
		this.visibleCount++;

		// Animate in
		setTimeout(() => {
			notification.classList.remove('opacity-0', 'translate-y-[-20px]');
		}, 10);

		// Auto-remove after duration
		if (type === 'success') {
			setTimeout(() => {
				this.removeNotification(notification);
			}, duration);
		}

		// Continue processing queue
		setTimeout(() => {
			this.processQueue();
		}, 300);
	}

	/**
	 * Remove a notification
	 * @param {HTMLElement} notification - The notification to remove
	 */
	removeNotification(notification) {
		// Skip if already being removed
		if (notification.classList.contains('removing')) return;
		notification.classList.add('removing');

		// Animate out
		notification.classList.add('opacity-0', 'translate-y-[-10px]');

		// Remove after animation
		setTimeout(() => {
			if (notification.parentNode === this.container) {
				this.container.removeChild(notification);
				this.visibleCount--;

				// Continue processing queue if needed
				if (
					this.queue.length > 0 &&
					this.visibleCount < this.maxVisible
				) {
					this.processQueue();
				}
			}
		}, 300);
	}
}

// Initialize notification manager
export const notificationManager = new ERDNotificationManager();
