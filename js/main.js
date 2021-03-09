
/*------- Side Nav Function ----------*/

let widthToggle = false;

$(".btn_history").click(function(){
	let sideNavWidthOriginal = "5rem";
	let sideNavWidthNew = "30rem";
	widthToggle = !widthToggle;
	if(widthToggle){
		$(".custom_navbar").width(sideNavWidthNew);
		$(".action_container").removeClass("hidden");
		$(".side_nav_heading").removeClass("hidden");
	}else{
		$(".custom_navbar").width(sideNavWidthOriginal);		
		$(".action_container").addClass("hidden");
		$(".side_nav_heading").addClass("hidden");
	}
});

/*-------------------------------*/


const actions = {
	paragraph: 'Added Paragraph',
	comment: 'Added Comment',
	delete_paragraph: 'Deleted Paragraph',
	rearrage: 'Rearranged Paragraphs',
	name: 'Changed Essay Name To'
};

const paragraphRegx = new RegExp('<(|\/|[^>\/bi]|\/[^>bi]|[^\/>][^>]+|\/[^>][^>]+)>','g');
const user = valenceUserData['FirstName']+ ' ' + valenceUserData['LastName'];


$(".btn_send").click(function(e){
	
	let html = "";
	let deleteIconHTML = '<div class="options_icons">' +
							'<div class="icon_delete">' +
								'<i class="fa fa-window-close" aria-hidden="true"></i>' +
							'</div>'+
						'</div>';
	let comment_btns = '<button class="btn add_comment"><i class="fa fa-commenting" aria-hidden="true"></i></button>' +
					   '<button class="btn view_comment"  data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-list" aria-hidden="true"></i></button>';
					
	let paragraphText  = $("#form24").val();
	paragraphText = paragraphText.trim();
	
	paragraphText = paragraphText.replace(paragraphRegx, '');
	
	if(!isEmpty(paragraphText)){
		
		let timeStamp = Date.now();
		let id = generateId(timeStamp);
		
		html = '<div class="paragraphs" id="'+id+'" data-timeStamp="'+timeStamp+'">' +
					'<p>' + paragraphText +'</p>' + 
					 deleteIconHTML + 
					 comment_btns +
				'</div>';
		
		let tempPara = {};
		
		tempPara.id = id;
		tempPara.text = paragraphText;
		tempPara.timeStamp = timeStamp.toString();

		EssayJSON.paragraphs.push(tempPara);
		EssayJSON.actions.push(buildAction(actions.paragraph,timeStamp,user, paragraphText));
		
		$("#allParagraphs").append(html);
		$("#form24").val('');
	}
	
});


$(document).on("click", ".icon_delete" , function() {
	let paragraphText = "";
	let paraId = $(this).closest('.paragraphs').attr('id');
	$.each(EssayJSON.paragraphs,function(i,obj){
		if(obj.id === paraId){
			obj.delete = 'true';
			paragraphText = obj.text;
		}		
	});
	
	$.each(EssayJSON.comments,function(i,obj){
		if(obj.paragraphId === paraId){
			obj.delete = 'true';
		}		
	});
	
	let timeStamp = Date.now();
	
	EssayJSON.actions.push(buildAction(actions.delete_paragraph,timeStamp,user, paragraphText));

    $(this).closest(".paragraphs").remove();
});


$(document).on("click", ".btn_cancel" , function() {
    $(this).closest(".comment_container").remove();
});

$(document).on("click", ".add_comment" , function() {
			
	let html = '<div class="comment_container">' +
				'<div class="user_name">' +
					'<i class="fa fa-user-circle" aria-hidden="true"></i>' +
					'<p>'+ user + '</p>'+
				'</div>' +
				'<textarea class="comment_textarea"></textarea>' +
				'<button class="btn btn-primary btn_save">Save</button>' +
				'<button class="btn btn-secondary btn_cancel">cancel</button>' +
				'</div>';
	if($(this).closest(".paragraphs").find('div.comment_container').length == 0){
		let ele = $(this).closest(".paragraphs");
		ele.append(html);
	}
	
});
			   
$(document).on("click", ".btn_save" , function() {
	
	let tempJSON = {};
	let timeStamp = Date.now();
	tempJSON.userFirstName = valenceUserData['FirstName'];
	tempJSON.userLastName = valenceUserData['LastName'];
	tempJSON.paragraphId = $(this).closest(".paragraphs").attr('id');
	let text_area_el = $(this).prev(".comment_textarea");
	tempJSON.text = text_area_el.val().replace(paragraphRegx, '');
	tempJSON.timeStamp = timeStamp.toString();
	
	EssayJSON.comments.push(tempJSON);
	EssayJSON.actions.push(buildAction(actions.comment,timeStamp,user, text_area_el.val().replace(paragraphRegx, ''),tempJSON.paragraphId));
	
	$(this).closest(".comment_container").remove();
	
});

$(document).on("click", ".view_comment" , function() {
	
	cleanModal();
	let ele  = $(this).closest(".paragraphs");
	let paraId = ele.attr('id');
	let paraText = ele.first("p").text();
	let html = '';
	
	let paratext_html = '<div class="paraText">'+paraText+'</div>';
	$('.modal-para-text').append(paratext_html);
	
	$.each(EssayJSON.comments, function(i,obj) {	
		if(obj.paragraphId === paraId){
			html = "";
			  html += '<div class="user_comment">' +
						  '<div class="user_name">' +
							  '<i class="fa fa-user-circle" aria-hidden="true"></i>'+
							  '<p>'+obj['userFirstName']+ ' ' + obj['userLastName'] + '</p>'+
							  '<p>'+ obj.text +'</p>'+
						  '</div>'+
					  '</div>';
				$('.modal-body').append(html);
		}
	});

});

$("#title_text").change(function(){	
	EssayJSON.name = $(this).val();	
	let timeStamp = Date.now();
	EssayJSON.actions.push(buildAction(actions.name,timeStamp,user,null,null,EssayJSON.name));
});


$(".btn_save_progress").click(function() {
	
	switchLoader(true);
	UpdateData(EssayJSON,EssayJSON.Id);
});

function isEmpty(str)
{
    return (!str || 0 === str.length);
}

function buildAction(type,timeStamp,owner,text,paragraphId = null,name = null){
	
	let tempAction = {};
	
	if(paragraphId){
		tempAction.paragraphId = paragraphId;
	}

	if(name){
		tempAction.name = name;
	}

	tempAction.type = type;
	tempAction.timeStamp = timeStamp;
	tempAction.owner = owner;
	tempAction.text = text;
	addAction(tempAction);

	return tempAction;
}

function generateId(dateTime){
	let base64 = 0;
	
	if(isEmpty(dateTime)){
		return base64;
	}
	
	base64 = btoa(dateTime);
	return base64;
}

function cleanModal(){
	$('.modal-body').empty();
	$('.modal-para-text').empty();
	$('.modal-body').append('<h5>Comments:</h5>');
}

function updateParaJSON(evt){
	EssayJSON.paragraphs = [];
	let tempPara = {};
	$('.paragraphs').each(function(){
		tempPara.id = $(this).attr("id");
		tempPara.text = $(this).text();
		tempPara.timeStamp = $(this).attr("data-timeStamp");
		EssayJSON.paragraphs.push(tempPara);
		tempPara = {};
	});
}

function actionRearrange(){
	
	let timeStamp = Date.now();
	let tempAction = {};
	tempAction.type = actions.rearrage;
	tempAction.timeStamp = timeStamp;
	tempAction.owner = valenceUserData['FirstName']+ ' ' + valenceUserData['LastName'];
	
	EssayJSON.actions.push(tempAction);
	addAction(tempAction);
}

