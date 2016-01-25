$(document).ready(function(){
	console.log('working');
	// /***icons rounded**/
	// $('i.fi-round').each(function(){
	// 	var parclr = $(this).parent().css('background-color');
	// 	var clr = $(this).css('color');
	// 	$(this).css('color', parclr);
	// 	$(this).css('background-color', clr);
	// 	console.log(parclr);
	// });


	///////////////////////////////////////////
	//set minimuin width for the desktop display
	$('.full-width').css({'min-width':'1170px'});

	/////////////////////////////////

	//delay function 
	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();



	//ajax links
	var linkAnchor = $('a.link-anchor');

	$(document).on('click', 'a.link-anchor', function(e){
		console.log('clicked dynamic link');
		e.preventDefault();
		e.stopPropagation();
		var url = $(this).data('url');
		var method = $(this).data('method');
		if(method == 'post'){
			var tarid = $(this).data('id');
			var target = $('#'+tarid);
			var postData = {};
			postData[target.data('name')] = target.val();
			$.when(http_post(url, postData)).then(function(response){
				target.val('');
				location.reload();
			}, function(response){

			});
		}
		if(method == 'get'){
			$.when(http_get(url)).then(function(response){
				location.reload();
			}, function(response){

			});
		}
		if(method == 'redirect'){
			window.location.replace(url);
		}
	});

	/****ajax search on data table*****
	**************************************/
	var searcbox = $('input.data-table-search');
	var nativeRows = $('tr.native-records');
	var targetTable;
	searcbox.on('keyup', function(){
		var $this = $(this);
		if($this.val().length >= 1){
			delay(function(){
				var key = $this.val();
				var targetname = $this.data('searchTable');
				targetTable = $('table').data('table',targetname);
				console.log(targetname);
				var url = 'admin/'+targetname+'/search/'+key;
				$.when(http_get(url)).then(function(response){
					//console.log(response);
					filterProdTable(response);
				}, function(response){
					console.log(response);
				});
			}, 700);
		}else{
			removedynamic();
			nativeRows.show();
		}
	});

	function removedynamic(){
		$('tr.dynamic-records').remove();
		console.log('method called');
	}

	function filterProdTable(products){
		removedynamic();
		nativeRows.hide();
		$.each(products, function(i, item){
			var row ='<tr class="dynamic-records">'
						+'<td><input type="checkbox" name="select_all"></td>'
						+'<td>'+item.product_name+'</td>'
						+'<td>'+item.category.category_name+'</td>'
						+'<td>'+item.price+'</td>'
						+'<td>'+item.mrp+'</td>'
						+'<td>'+item.brand.brand_name+'</td>'
						+'<td><ul class="table-row-controls">'
						+'<li><input type="submit" class="button tiny delete alert link" value=""></li>'
						+'<li><a class="primary" href="admin/product/'+item.id+'"><i class="fa fa-pencil-square-o"></i></a></li></ul>'
						+'</td></tr>';
			targetTable.append(row);
		});
	}





	/***Add to cart-wrapper appear***/
	// var caroProd = $('.caro-prod');

	// caroProd.hover(function(){
	// 	$(this).find('.add-to-wrapper').velocity("fadeIn", { duration: 300 });
	// 	console.log('entered');
	// },
	//  function(){
	// 	$(this).find('.add-to-wrapper').velocity("fadeOut", { duration: 300 });
	// });

	//register form
	function showToastr(msg, xtime){
		
	}
	var regBtn = $('button#registerBtn');
	var regWrapper = $('.reg-wrapper')
	var registerForm = {};
	regBtn.on('click', function(){

		registerForm['mobile'] = regWrapper.find('input#mobile').val();
		registerForm['email'] = regWrapper.find('input#email').val();
		registerForm['password'] = regWrapper.find('input#password').val();
		registerForm['password_confirmation'] = regWrapper.find('input#cpassword').val();
		
		if(regWrapper.find('#iagree').is(':checked')){
			registerForm['terms'] = 1;
		}else{
			delete registerForm['terms'];
		}
		registerForm['area_id'] = regWrapper.find('select#area_id').val();
		//console.log(registerForm);
		$.when(http_post('register', registerForm)).then(function(){
			window.location.replace("/registration/success");
			//$('#signupModal').foundation('reveal', 'close');
		}, function(response){
			if(response.status === 422){
				var j = 0;
				$.each(response.responseJSON, function(i, item){
					console.log(i);
					setTimeout(function(){
						
						toastr.error(item, {timeOut:3500});
					}, j * 3500);
					j = j+1;
				});
			}
		});
	});


	//Login form
	var loginBtn = $('button#loginBtn');
	var loginWrapper = $('.login-wrapper')
	var loginForm = {};
	loginBtn.on('click', function(){

		loginForm['email'] = loginWrapper.find('input#email').val();
		loginForm['password'] = loginWrapper.find('input#password').val();
		$.when(http_post('authenticate', loginForm)).then(function(response){
			if(response == 'false'){
				console.log(response);
			}else{
				$('#loginModal').foundation('reveal', 'close');
				location.reload();
			}
			
		}, function(response){
			if(response.status === 422){
				var j = 0;
				$.each(response.responseJSON, function(i, item){
					console.log(i);
					setTimeout(function(){
						toastr.error(item, {timeOut:3500});
					}, j * 3500);
					j = j+1;
				});
			}
		});
	});

	//change delivery area
	$('#deli-area').on('change', function(){
		var postData = {};
		postData['area'] = $(this).val();
		//console.log
		http_post('/changeArea', postData);
	});
	$('#deli-time').on('change', function(){
		var postData = {};
		postData['time'] = $(this).find('option:selected').text();
		//console.log
		http_post('/changeArea', postData);
	});

	/****** Main Ajax search ********/
	var searchtimer;
	$('.ajax-search-input').on('keypress', function(){
		var liststxt = '.ajax-search-lists[data-id="'+$(this).data('target')+'"]';
		var lists = $(liststxt);
		clearTimeout(searchtimer);
		if($(this).val().length > 2){
			$this = $(this);
			searchtimer = setTimeout(function(){
				var key = $this.val()
				$.when(http_get('/mainsearch?search='+key)).then(function(response){
					lists.empty();
					lists.show();
					console.log(response.products);
					if(response.count > 0){
						$.each(response.products, function(i, item){
							var list = '<li><a class="link-anchor" data-method="redirect" data-url="/product/'+item.id+'">'
	                    				+'<div class="row"><div class="small-2 columns"><div class="img-wrapper">'
	                          			+'<img src="images/products/'+item.images[0]['image_name']+'" alt="">'
	                        			+'</div></div><div class="small-6 end columns">'
	                        			+'<p class="tiny tight"><b>'+item.product_name+'</b> | '
	                        			+item.local_name+' </p></div></div></a></li>';
							// var list = '<li><a href="'+item.id+'">'
	      //               				+'<div class="row"><div class="small-2 columns"><div class="img-wrapper">'
	      //                     			+'<img src="images/products/orange.jpg" alt="">'
	      //                   			+'</div></div><div class="small-6 columns">'
	      //                   			+'<p class="tiny tight"><b>'+item.product_name+'</b> | '
	      //                   			+item.local_name+' (500g)</p>'
	      //                 				+'</div><div class="small-2 columns"><p class="tiny tight strike-through danger">'
	      //                 				+'Mrp Rs. 45</p></div><div class="small-2 columns">'
	      //                   			+'<p class="tiny tight text-right"><b>Rs. 30</b></p></div></div></a></li>';
	                        lists.prepend(list);

						});
					}else{
						lists.text('Sorry no products match!');
					}
				}, function(){
					console.log('error');
				});
			}, 700);
	
		}
	});
	$('.ajax-search-input').on('blur', function(){
		$this = $(this);
		setTimeout(function(){
		  var liststxt = '.ajax-search-lists[data-id="'+$this.data('target')+'"]';
		  var lists = $(liststxt);
		  lists.hide();
		}, 500);
		
	});

	toastr.options = {
	  "closeButton": false,
	  "debug": false,
	  "newestOnTop": false,
	  "progressBar": false,
	  "positionClass": "toast-top-center",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "700",
	  "timeOut": "3000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}


});
