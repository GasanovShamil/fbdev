$(document).ready(function() {
	$( ".toggle-slide" ).click(function() {
		var target = $(this).data('slide');
		$(target).slideToggle();
		$(this).find('.icon-plus').toggle();
		$(this).find('.icon-minus').toggle();
	});
});