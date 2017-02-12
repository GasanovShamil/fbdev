$(document).ready(function() {
	$("#photo-modal").off("show.bs.modal");
	$("#photo-modal").on("show.bs.modal", function (event) {
		// Source
		var source = $(event.relatedTarget);

		// Information
		var name = source.data("name");
		var url = source.data("url");

		// Change the modal
		var modal = $(this);
		modal.find(".modal-header .modal-title").html(name);
		modal.find(".modal-body img").attr("src", url);
	})
});