//close all models
	var cancelBtn = $('.cancelModalBtn');

	cancelBtn.on('click', function(e){
		e.preventDefault();
		$('.close-reveal-modal').trigger('click');
	});

	//launch edit modal
	$('.icon-button').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		var action = $(this).data('action');
		var model = $(this).data('model');
		var id = $(this).data('id');
		console.log(action, model, id);
		var modalID;
		var postData = {};
		switch(model)
		{
			case 'category':
				if(action == 'edit'){
					modalID = '#editCateModal';
					btn = '#cateUpdateBtn';
					url = 'admin/category/'+id;
					method = "put";
					form = '#editCateForm';
					getInput('category');
					printInput(form);
				}else if(action =='del'){
					modalID = '#delCateModal';
					btn = '#cateDelBtn';
					url = 'admin/category/'+id;
					method = "delete";
				}
			break;
		}
		function getInput(model){
			
		}

		$(modalID).foundation('reveal', 'open');
		$(btn).on('click', function(){
			//var response = http_post(url, postData);
			console.log(postData);
		});

	});