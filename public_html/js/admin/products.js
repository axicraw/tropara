/****************
****Prices****
**************/
$.views.settings.delimiters("{%", "%}");
//load prices
var prices;
$.when(http_get('admin/product/'+PROD_ID+'/prices')).then(function(response){
	prices = (response);
	loadprices(prices);
}, function(){
	console.log('failed to get the prices');
});
var quanpriceLists = $('#quan-prices');
function loadprices(data){
	// render tmplate
	quanpriceLists.find('.quan-price.old').parent().remove();
	quanpriceLists.prepend($('#quant-price-tmpl').render(data));
}
///create product
var emptyquanBtn = $('#empty-quan-price');
var savequanBtn = $('.save-quan-price');
var delquanBtn = $('.del-quan-price');

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