$(document).ready(function() {
	$(".album-item").click(function () {
		$('#photos .box-group').html($("#waiting-div").html());
		var showUrl = $(this).data('show');

		$.ajax({
			url: showUrl,
			dataType: "html",
			success: function (data) {
				$('#photos .box-group').html(data);

				$( ".toggle-slide" ).click(function() {
					var target = $(this).data('slide');
					$(target).slideToggle();
					$(this).find('.glyphicon-plus').toggle();
					$(this).find('.glyphicon-minus').toggle();
				});
			}
		});
	});
});