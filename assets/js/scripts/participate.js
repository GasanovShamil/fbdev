$(document).ready(function() {
	$(".album-item").click(function () {
		$('#photos .box-group').html($("#waiting-div").html());
		var showUrl = $(this).data('show');

		$.ajax({
			url: showUrl,
			dataType: "html",
			success: function (data) {
				$('#photos .box-group').html(data);
			}
		});
	});

	$("#confirmation-modal").off("show.bs.modal");
	$("#confirmation-modal").on("show.bs.modal", function (event) {
		// Source
		var source = $(event.relatedTarget);

		// Information
		var participateUrl = $(this).data('participate');
		alert(participateUrl);

		// Change the modal
		var modal = $(this);
		modal.find("#participate").attr('href', participateUrl);
	});
});