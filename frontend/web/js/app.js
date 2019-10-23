// Language class
var Language = new function () {

	this.change = function (id) {
		$.ajax({
			type: 'GET',
			url: frontendBaseURL + '/language/change',
			data: {'id': id},
			success: function () {
				window.location.href = '';
			}
		});
	}

};

// PWA - Only register a service worker if it's supported
if ('serviceWorker' in navigator) {
	console.log('PWA supported!');

	window.addEventListener('load', () => {
		navigator.serviceWorker.register('/service-worker.js')
			.then((reg) => {
				console.log('Service worker registered.', reg);
			});
	});
} else {
	console.log('PWA not supported!');
}