$(document).ready(function() {
	$( ".toggle-slide" ).click(function() {
		var target = $(this).data('slide');
		$(target).slideToggle();
		$(this).find('.glyphicon-plus').toggle();
		$(this).find('.glyphicon-minus').toggle();
	});

	$("#photo-modal").off("show.bs.modal");
	$("#photo-modal").on("show.bs.modal", function (event) {
		// Source
		var source = $(event.relatedTarget);

		// Information
		var name = source.data("label");
		var url = source.data("url");

		// Change the modal
		var modal = $(this);
		modal.find(".modal-header .modal-title").html(name);
		modal.find(".modal-body img").attr("src", url);
	});
});