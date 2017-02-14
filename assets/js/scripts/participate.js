$(document).ready(function() {
	$( ".toggle-slide" ).click(function() {
		var target = $(this).data('slide');
		$(target).slideToggle();
	});
});