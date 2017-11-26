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


// ekko lightbox
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
	event.preventDefault();
	$(this).ekkoLightbox();
});