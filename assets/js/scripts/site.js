$(document).ready(function() {
	$('.toggle-slide').click(function() {
		var target = $(this).data('slide');
		$(target).slideToggle();
		$(this).find('.glyphicon-plus').toggle();
		$(this).find('.glyphicon-minus').toggle();
	});
});