function modalError(modal, error){	
	var errorList = modal.find('.modal-error ul'),
		errorStr = '<li>'+error+' &nbsp;&nbsp;<i class="ion-alert"></i></li>',
		errorElem = $(errorStr);

	errorList.append(errorElem);
	setTimeout(function(){
		errorElem.fadeOut();
	}, 3000);
}



function hideError(errorList){
	error = errorList.find('div.form-error');
	console.log(error);
	setTimeout(function(){
		error.fadeOut();
	}, 3000);
}
