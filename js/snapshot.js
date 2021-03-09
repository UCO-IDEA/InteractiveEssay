function addAction(action){
	
	let actionHTML = "";
	let d = new Date(action.timeStamp);
	let timeStamp = ("0" + (d.getMonth()+1)).slice(-2) + '/' + ("0" + d.getDate()).slice(-2) + '/' + d.getFullYear();

	if(action.type === 'Add Paragraph' || action.type === 'Added Paragraph'){
		actionHTML = "<div class='action'><strong>" + action.owner + "</strong> " + action.type + "<div class='action_text'><p>"+ action.text +"</p></div>" + timeStamp;
	}
	if(action.type === 'Added Comment'){
		actionHTML = "<div class='action'><strong>" + action.owner + "</strong> " + action.type + "<div class='action_text' data-toggle='modal' data-target='#exampleModalCenter' data-paragraph='"+action.paragraphId+"'><p>"+ action.text +"</p></div>" + timeStamp;
	}
	if(action.type === 'Deleted Paragraph'){
		actionHTML = "<div class='action'><strong>" + action.owner + "</strong> " + action.type + "<div class='action_text'><p>"+ action.text +"</p></div>" + timeStamp;
	}
	if(action.type === 'Rearranged Paragraph' || action.type === 'Rearranged Paragraphs'){
		actionHTML = "<div class='action'><strong>" + action.owner + "</strong> " + action.type + " <br>" + timeStamp;
	}
	if(action.type === 'Changed Essay Name To'){
		actionHTML = "<div class='action'><strong>" + action.owner + "</strong> " + action.type + " <span class='essay_name'>" + action.name + "</span> <br>" + timeStamp;
	}
	
	$(".action_container").prepend(actionHTML);
}