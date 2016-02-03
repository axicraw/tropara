$(document).ready(function(){
	
	//button links (used in categories editing);
	$('button.link').on('click', function(e){
		e.preventDefault();
		var path = $(this).data('src');
		if($(this).data('method') == 'delete'){
			var data = {"_method":"DELETE"};
			$.when(http_post(path, data)).then(function(response){
				console.log(response);
			}, function(response){
				console.log(response);
			})
			location.reload();
		}else{
			window.location.href = path;
		}
	});


});