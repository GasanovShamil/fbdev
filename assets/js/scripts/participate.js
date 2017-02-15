$(document).ready(function() {
	$(".album-item").click(function () {
		$('#photos .box-group').html($("#waiting-div").html());
		var showUrl = $(this).data('show');

		$.ajax({
			url: showUrl,
			dataType: "html",
			success: function (data) {
				$('#photos .box-group').html(data);

				$('.box-slide').click(function() {
					var target = $(this).data('slide');
					$(this).slideToggle();
					$(target).slideToggle();
				});

				$('.confirmation-slide').click(function() {
					var target = $(this).data('slide');
					$('#confirmation-' + target).slideToggle();
					$('#photo-' + target).slideToggle();
				});
			}
		});
	});
});