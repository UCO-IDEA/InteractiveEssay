<!doctype html>
<html lang="en">

<head>

<?php require_once('head.php'); ?>	
<title>Interactive Essay</title>

<script src="js/loader.js"></script>
<script src="js/ADO_API.js"></script>

</head>

<body>

<div class="loader loaderHidden">
	<img src="img/loading.gif" alt="Loading..."/>
</div>

	<div class="container">
		<div class="row">
			
			<div class="col-sm-12" id="logo_heading">
				<div class="row">
					<div class="ml-auto col-sm-3">
						<img class="img-fluid header-img" src="logo/Interactive_Essay_Logo_Large.svg">
					</div>
					<div class="col-sm-7">
						<h1 class="primary-color">INTERACTIVE ESSAY</h1>
						<h3 class="text-gray">A group essay building excercise</h3>
					</div>
				</div>
			</div>
			
			<div class="col-sm-6">
				<div class="card text-center">
					<div class="card-header primary-bg text-white">
						<h2>Start an Essay</h2>
					</div>
						<div class="card-body mt-1">
							<a type="button" href="https://docs.google.com/document/d/1LA7uv9qSCbM_eFXn3zEslLMKc_mT_jX4H6Kf4SD5pXI/edit?usp=sharing" target="_blank" class="btn btn-secondary">Instructions</a>
							<a type="button" href="" class="btn btn-primary btn_new_essay">Get Your URL</a>
							<p class="text-black mt-3">Already created your URL?</p>
							<p>Enter the essay link you were given into your browser address bar.</p>
						</div>
					</div>
			</div>
			<div class="col-sm-6">
					<div class="card text-center">
						<div class="card-header primary-bg text-white">
							<h2>Have an Essay?</h2>
						</div>
						<div class="card-body mt-1">
							<p>View Essays by entering the URLs shared with you.</p>
						</div>
					</div>
			</div>
			
			<div id="newURL" class="col-sm-12">
			</div>

		</div>
	</div>

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
<script src="js/config.js"></script>
<script>

	$(".btn_new_essay").click(function(e){
		e.preventDefault();
		switchLoader(true);
		PostData();
	});

	function setNewURL(Id){
		const html = `<div class="card mb-3 mt-5">
						<div class="card-header primary-bg text-white">
							<h2>Essay URL</h2>
						</div>
						<div class="card-body">
							<h5><i class="fa fa-users mr-3 primary-color" aria-hidden="true"></i><a class="text-gray" href="${home}LoadEssay.php?id=${Id.newId}">${home}LoadEssay.php?id=${Id.newId}</a></h5>
						</div>
					</div>`;
		$("#newURL").append(html);
	
		$('html, body').animate({
          scrollTop: $("#newURL").offset().top
        }, 400);
	}
</script>

</body>

</html>