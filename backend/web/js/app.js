/**
 * AdminLTE remember open/close state of sidebar menu
 */
$.AdminLTESidebarTweak = {};

$.AdminLTESidebarTweak.options = {
	enableRemember: true,
	noTransitionAfterReload: true
};

$(function () {
	'use strict';

	$('body').on('collapsed.pushMenu', function () {
		$.ajax({
			type: 'GET',
			url: backendBaseURL + '/site/set-sidebar-menu-state',
			data: {'state': 'closed'}
		});
	});

	$('body').on("expanded.pushMenu", function () {
		$.ajax({
			type: 'GET',
			url: backendBaseURL + '/site/set-sidebar-menu-state',
			data: {'state': 'opened'}
		});
	});
});