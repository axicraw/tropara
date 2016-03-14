/****************
****Prices****
**************/
$.views.settings.delimiters("{%", "%}");
//load prices
var prices;

//get all the prices for the product
$.when(http_get('admin/product/'+PROD_ID+'/prices')).then(function(response){
	prices = (response);
	loadprices(prices);
}, function(){
	console.log('failed to get the prices');
});

// get all the mrp
$.when(http_get('admin/product/'+PROD_ID+'/mrp')).then(function(response){
	mrps = (response);
	loadmrps(mrps);
}, function(){
	console.log('failed to get the mrps');
});
var quanpriceLists = $('#quan-prices');
var quanmrpLists = $('#quan-mrps');
function loadprices(data){
	// render tmplate
	quanpriceLists.find('.quan-price.old').parent().remove();
	quanpriceLists.prepend($('#quant-price-tmpl').render(data));
}
function loadmrps(data){
	// render tmplate
	quanmrpLists.find('.quan-mrp.old').parent().remove();
	quanmrpLists.prepend($('#quant-mrp-tmpl').render(data));
}
///create or update product price
var emptyquanBtn = $('#empty-quan-price');
var savequanBtn = $('.save-quan-price');
var delquanBtn = $('.del-quan-price');
var savequanmrpBtn = $('.save-quan-mrp');
var delquanmrpBtn = $('.del-quan-mrp');

$(document).on('click', '.save-quan-price', function(e){
	e.preventDefault();
	//forging quan-price
	var quanprice = {};
	var quanpriceWrapper = $(this).parents('.quan-price');
	var id = $(this).data('id');
	quanprice['product_id'] = quanpriceWrapper.data('product');
	quanprice['qty'] = quanpriceWrapper.find('input.quantity').val();
	quanprice['unit_id'] = quanpriceWrapper.find('select.quan-unit').val();
	quanprice['price'] = quanpriceWrapper.find('input.price').val();

	if(id > 0){
		updatePrice(quanprice, id);
	}else{
		createPrice(quanprice);
	}
});
$(document).on('click', '.del-quan-price', function(e){
	e.preventDefault();
	var quanpriceWrapper = $(this).parents('.quan-price');
	var id = $(this).data('id');
	$.when(http_delete('admin/product/deletePrice/'+id)).then(function(){
		quanpriceWrapper.remove();
	});
	
});

function createPrice(data){
	http_post('admin/product/createPrice', data);
	$.when(http_get('admin/product/'+PROD_ID+'/prices')).then(function(response){
		prices = (response);
		loadprices(prices);
	}, function(){
		console.log('failed to get the prices');
	});
}
function updatePrice(data, id){
	http_put('admin/product/updatePrice/'+id, data);
}

//create or update product mrp
$(document).on('click', '.save-quan-mrp', function(e){
	e.preventDefault();
	//forging quan-price
	var quanmrp = {};
	var quanpriceWrapper = $(this).parents('.quan-mrp');
	var id = $(this).data('id');
	quanmrp['product_id'] = quanpriceWrapper.data('product');
	quanmrp['qty'] = quanpriceWrapper.find('input.quantity').val();
	quanmrp['unit_id'] = quanpriceWrapper.find('select.quan-unit').val();
	quanmrp['mrp'] = quanpriceWrapper.find('input.mrp').val();

	//console.log(quanmrp);

	if(id > 0){
		updateMrp(quanmrp, id);
	}else{
		createMrp(quanmrp);
	}
});
$(document).on('click', '.del-quan-mrp', function(e){
	e.preventDefault();
	var quanpriceWrapper = $(this).parents('.quan-mrp');
	var id = $(this).data('id');
	$.when(http_delete('admin/product/deleteMrp/'+id)).then(function(){
		quanpriceWrapper.remove();
	});
	
});

function createMrp(data){
	http_post('admin/product/createMrp', data);
	$.when(http_get('admin/product/'+PROD_ID+'/mrp')).then(function(response){
		mrps = (response);
		loadmrps(mrps);
	}, function(){
		console.log('failed to get the prices');
	});
}
function updateMrp(data, id){
	http_put('admin/product/updateMrp/'+id, data);
}

/*********************
 * product picture
 ********************/
	var thumbInputsWrapper = $('#thumb-inputs-wrapper');
	var thumb_input 	= $("input.thumb-input");
	function readImg(input, target) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            target.attr({
	            	'src':e.target.result
	            });
	        }
	        reader.readAsDataURL(input.files[0]);		       
	    }
	}
	function addThumbInput(){
		var newInput = '<div class="medium-2 end columns"><div class="file-inp-container">'
						+ '<input type="file" name="prod_image[]" class="thumb-input" data-fresh="new">'
						+'<img src="" alt=""></div></div>';
		thumbInputsWrapper.find('>.row').append(newInput);
	}
	function updateImage(imageid, prodid){
		var post_data = {};
		post_data['imageid']=imageid;
		post_data['prodid']=prodid;
		$.when(http_post('admin/product/updateImage', post_data)).then(function(){
			console.log('update success');
		}, function(){
			console.log('update failure');
		});
	}
	thumbInputsWrapper.on('change', "input.thumb-input", function(){	
		var target = $(this).siblings('img');
	    readImg(this, target);
	    var removeBtn = '<button class="button tiny alert remove-thumb-input"><i class="fa fa-close"></i></button>';
	    $(this).parent().find('button.remove-thumb-input').remove();
	   	$(this).parent().append(removeBtn);
	   	//var datafresh = $(this).data('fresh');

	   	if($(this).data('fresh') == 'new'){
	   		console.log('new clicked')
	   		addThumbInput();
	   		$(this).data('fresh', 'old');
	   	}else{
	   		if($(this).data('imageId')){
	   			var imageid = $(this).data('imageId');
	   			var prodid = $(this).data('prodId');
	   			//$(this).attr('name', 'prod_image[]');
	   			updateImage(imageid, prodid);
	   		}
	   	}
	    
	});
	thumbInputsWrapper.on('click', "button.remove-thumb-input", function(e){
		e.preventDefault();
		var prod_id = $(this).data('prod-id')
		var image_id=$(this).data('image-id');

		http_delete('admin/product/deleteImage/'+prod_id+'/'+image_id);
		$(this).closest('.columns').remove();
		
	});


	// pp_cancel.on('click', function(){
	// 	pp_img.attr('src', '');
	// 	$(this).hide()
	// });