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
	});

	$(".btn-vote").click(function () {
		var voteUrl = $(this).data('vote');

		$.ajax({
			url: voteUrl,
			dataType: "html",
			success: function (data) {
				$(this).animate({width:'toggle'},350);
				alert("yeah !");
			}
		});
	});

	$(".btn-unvote").click(function () {
		var unvoteUrl = $(this).data('unvote');
		
		$.ajax({
			url: unvoteUrl,
			dataType: "html",
			success: function (data) {
				$("#add-budget #add-budget-historical-adds").html(data);
				$("#add-budget .table-scroll").mCustomScrollbar();
			}
		});
	});





});