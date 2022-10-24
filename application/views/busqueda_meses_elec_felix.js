$(document).ready(function() {
	listRecords();
	$('#multiSelectSearch').change(function() {
		console.log($('#multiSelectSearch').val());
		$('#location').val($('#multiSelectSearch').val());
		var searchQuery = $('#location').val();
		listRecords(searchQuery);
	});
});
function listRecords(searchQuery='') {
	$.ajax({
		url:"live_search.php",
		method:"POST",
		dataType: "json",
		data:{query:searchQuery},
		success:function(response) {
			$('tbody').html(response.html);
		}
	});
}