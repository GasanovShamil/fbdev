$(document).ready(function() {
	init();
});

function init() {
	$( ".toggle-slide" ).click(function() {
		var target = $(this).data('slide');
		$(target).slideToggle();
		$(this).find('.glyphicon-plus').toggle();
		$(this).find('.glyphicon-minus').toggle();
	});
}