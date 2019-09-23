$('#generate').on('submit', function(event){
	event.preventDefault();
	var that = $(this);
		contents = that.serialize();

	$.ajax({
		url: '/api/generate/index.php',
		dataType: 'json',
		type: 'post',
		data: contents,
		success: function(data){
			console.log(data);
		}
	});
})