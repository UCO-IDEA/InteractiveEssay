// JavaScript Document

const method = 'POST';
const url = 'controller.php';

const PostData = () => {
		$.ajax({
			method: method,
			url: url,
			data: {'post':'post'},
			success: function(data){
				switchLoader(false);
				setNewURL(JSON.parse(data));
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log({result:'error',errorType:'AJAX Client Error',jqXHR:jqXHR, textStatus: textStatus, errorThrown: errorThrown});
			}
		});
}

const UpdateData = (EssayJSON) => {
	if(EssayJSON.paragraphs.length >= 1){
		console.log(EssayJSON);
		$.ajax({
			method: method,
			url: url,
			data: {'id':EssayJSON.id,'EssayJSON':EssayJSON},
			success: function(data){
				switchLoader(false);
				messaageBox(JSON.parse(data));
			},
			error: function(jqXHR, textStatus, errorThrown){
				console.log({result:'error',errorType:'AJAX Client Error',jqXHR:jqXHR, textStatus: textStatus, errorThrown: errorThrown});
			}
		});	
	}
}