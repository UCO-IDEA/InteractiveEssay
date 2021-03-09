/*-------- Loader Function -----*/

function switchLoader(toggle){
	const loaderElement = $(".loader");
    console.log(toggle);
	if(toggle){
		loaderElement.removeClass("loaderHidden");
	}else{
		loaderElement.addClass("loaderHidden");
	}
}

/*---------------------------------*/