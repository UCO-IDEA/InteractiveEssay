// JavaScript Document

let colors  = {
	sucess: '#3598db',
	error: '#e84c3d',
	warning: '#f39c11'
};
var timeOut;

$(document).on("click", ".fa-times" , function() {
	if($(this).parents('#messageBox').length){
		let element = $(this).parents('#messageBox');
		element.addClass("hidden");
		clearTimeout(timeOut);
	}
});

function messaageBox(responseText){
	console.log(responseText);
	cleanMessageBox();
	let message = "";
	let color = "";
	if(responseText.result){
		if(responseText.result == 'success'){
			message  = "Progress Saved.";
			color = colors.sucess;
		}else if(responseText.result == 'error' && responseText.errorDescription == 'Outdated Data' ){
			message = "Warning: Data has been updated since you last accessed it.";
			color = colors.warning;
		}else {
			message =  responseText.errorDescription;
			color = colors.error;
		}
	}else{
		message = "Unable to process request.";
		color = colors.error;
	}
	
	$(".message_text").prepend(message);
	$(".message_text").css("background",color);
	$("#messageBox").removeClass("hidden");
	
	if(!$("#messageBox").hasClass("hidden")) {
		timeOut = setTimeout(function(){ $("#messageBox").addClass("hidden"); },10000);
	}
}

function cleanMessageBox(){
	$('.message_text').empty();
	$('.message_text').append('<i class="fa fa-times" aria-hidden="true"></i>');
}