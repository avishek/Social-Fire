$(function() {
	$("#trows").on('change', function() {
		value = $(this).val();
		switch(value)
		{
			case "all":
				$("#taskTable tr").show();
				break;
			case "priority":
				$("#taskTable tr").hide();
				$("#taskTable tr.error").show();
				break;
			case "closed":
				$("#taskTable tr").hide();
				$("#taskTable tr.info").show();
				break;
			case "open":
				$("#taskTable tr").show();
				$("#taskTable tr.error").hide();
				$("#taskTable tr.info").hide();
				break;
		}
	});
});