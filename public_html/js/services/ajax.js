/***********
 * Get CSRF
 **********/
// var csrftoken = $.cookie('csrftoken'); //got from jquery.cookie script
// function csrfSafeMethod(method) {
//     // these HTTP methods do not require CSRF protection
//     return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
// }
// function sameOrigin(url) {
//     // test that a given url is a same-origin URL
//     // url could be relative or scheme relative or absolute
//     var host = document.location.host; // host + port
//     var protocol = document.location.protocol;
//     var sr_origin = '//' + host;
//     var origin = protocol + sr_origin;
//     // Allow absolute or scheme relative URLs to same origin
//     return (url == origin || url.slice(0, origin.length + 1) == origin + '/') ||
//         (url == sr_origin || url.slice(0, sr_origin.length + 1) == sr_origin + '/') ||
//         // or any other URL that isn't scheme relative or absolute i.e relative.
//         !(/^(\/\/|http:|https:).*/.test(url));
// }
$.ajaxSetup({
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function http_post(url, postData){
	console.log(postData);
    return $.ajax({
		url:url,
		data: postData,
		type: 'post'
	});
}

function http_get(url){
  return $.ajax({
    url:url,
    type: 'GET'
  });
}

function http_put(url, postData){
	return $.ajax({
		url:url,
		data:postData,
		type: 'PUT'
	});
}

function http_delete(url){
	return $.ajax({
		url:url,
		type: 'DELETE'
	});
}


