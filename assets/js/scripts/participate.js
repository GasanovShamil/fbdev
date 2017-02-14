$(document).ready(function() {
	$(".album-item").click(function () {
		$('#photos .box-group').html($("#waiting-div").html());
		var album = $(this).data('album');

		$.ajax({
			url: album,
			dataType: "html",
			success: function (data) {
				$('#photos .box-group').html(data);
			}
		});
	});
});