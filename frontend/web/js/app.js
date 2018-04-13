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