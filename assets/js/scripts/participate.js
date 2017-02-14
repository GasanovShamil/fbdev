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
});