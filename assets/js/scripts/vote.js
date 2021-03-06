$(document).ready(function() {
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
	
	$('.btn-success').mouseenter(function () {
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).find('.glyphicon').removeClass('glyphicon-ok');
		$(this).find('.glyphicon').addClass('glyphicon-remove');

		$('.btn-danger').mouseleave(function () {
			$(this).removeClass('btn-danger');
			$(this).addClass('btn-success');
			$(this).find('.glyphicon').removeClass('glyphicon-remove');
			$(this).find('.glyphicon').addClass('glyphicon-ok');
		});
	});

	$(".btn-vote").click(function () {
		var photo = $(this).data('photo');
		var voteUrl = $(this).data('vote');

		$.ajax({
			url: voteUrl,
			dataType: "html",
			success: function (data) {
				$('.btn-vote[data-photo="'+photo+'"]').addClass('hidden');
				$('.btn-unvote[data-photo="'+photo+'"]').removeClass('hidden');
				
				var nbVotes = parseInt($('.photo-vote[data-photo="'+photo+'"]').html());
				$('.photo-vote[data-photo="'+photo+'"]').html(++nbVotes);
			}
		});
	});

	$(".btn-unvote").click(function () {
		var photo = $(this).data('photo');
		var unvoteUrl = $(this).data('unvote');

		$.ajax({
			url: unvoteUrl,
			dataType: "html",
			success: function (data) {
				$('.btn-unvote[data-photo="'+photo+'"]').addClass('hidden');
				$('.btn-vote[data-photo="'+photo+'"]').removeClass('hidden');
				
				var nbVotes = parseInt($('.photo-vote[data-photo="'+photo+'"]').html());
				$('.photo-vote[data-photo="'+photo+'"]').html(--nbVotes);
			}
		});
	});
});