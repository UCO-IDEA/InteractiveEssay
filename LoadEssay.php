<!doctype html>
<html lang="en">

<head>

<link rel="stylesheet" type="text/css" href="Sortable-master/st/theme.css">
<?php require_once('head.php'); ?>	
<title>Interactive Essay</title>
<link rel="stylesheet" type="text/css" href="css/sidenav.css">

<?php  require_once('controller.php');?>

<?php 
	$essayData = getAllData($_GET['id']);
	if(array_key_exists("error",$essayData)){
		echo $essayData['error'];
		die();
	}
	$essayData = json_decode(($essayData[0])['EssayJSON']);
	echo "<script>var valenceUserData = {'FirstName':'".explode(" ",$essayData->owner)[0]."', 'LastName':'".explode(" ",$essayData->owner)[1]."'};</script>";
?>

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="crossorigin="anonymous"></script>
<script src="js/messagebox.js"></script>
<script src="js/snapshot.js"></script>
<?php echo "<script> var EssayJSON = ".json_encode($essayData)."</script>"; ?>

<body>

<div class="loader loaderHidden">
	<img src="img/loading.gif" alt="Loading..."/>
</div>

	<nav class="custom_navbar">
		<ul class="custom_navbar_nav">
			<li href="#" class="custom_nav_item side_nav_heading_container">
				<h4 class="side_nav_heading hidden">Version History</h4>
			</li>
			<li href="#" class="custom_nav_item">
				<button class="btn btn_history"><i class="fa fa-history" aria-hidden="true"></i></button>
			</li>
		</ul>
		<div class="action_container hidden">
		<?php require('actions.php');		?>
		</div>
	</nav>
	
	<div class="container-fluid">
		<div class="row">
			
			
			<!-- Modal Markup -->
			
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				 
				 <div class="modal-para-text">
				 </div>
				  <div class="modal-body">
					<h5>Comments:</h5>
					  <div class="user_comment">
						  <div class="user_name">
							  <i class="fa fa-user-circle" aria-hidden="true"></i>
							  <p>User Name</p>
							  <p>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ex</p>
						  </div>
					  </div>
					  
					  
					  <div class="user_comment">
						  <div class="user_name">
							  <i class="fa fa-user-circle" aria-hidden="true"></i>
							  <p>User Name</p>
							  <p>ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud ex</p>
						  </div>
					  </div>
					  
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary btn_modal_close" data-dismiss="modal">Close</button>
				  </div>
				</div>
			  </div>
			</div>
			
		    <!---------------->	
					
			<div class="row justify-content-center hidden" id="messageBox">
				<div class="col-sm-6 message_text"><i class="fa fa-times" aria-hidden="true"></i></div>
			</div>
			
			
			<div class="col-sm-12 text-align-left" id="heading"> <!-- id="heading"-->
				<div class="row">
						<img class="img-fluid header-img_small" src="logo/Interactive_Essay_Logo_Small.svg">
						<h5 class="primary-color text-bold ml-1 mt-4">INTERACTIVE</br>ESSAY</h5>
					<div class="col-4 mt-4">
						<a class="float-right text-black" href="index.php"><h3>Home</h3></a>
					</div>
					<div class="col-4 mt-4">
						<a href="https://docs.google.com/document/d/1LA7uv9qSCbM_eFXn3zEslLMKc_mT_jX4H6Kf4SD5pXI/edit?usp=sharing" target="_blank"><h3 class="text-gray">Learn More</h3></a>
					</div>
					<div class="col-2">
						<p class="current_user_load"><i class="fa fa-user-circle"></i><?php echo $essayData->owner ?></p>
					</div>
				</div>
			</div>
			
			
				<div class="col-sm-12 essay_name">
					<label for="title_text">Essay Title</label>
					<!--<h3 class="title_text"></h3>-->
					<input type="text" class="form-control" id="title_text" value=" <?php echo (!empty($essayData->name)) ? $essayData->name : "Untitled Essay" ?>">
				</div>

				
				<div class="col-sm-8 col-left" id="allParagraphs">
					<?php require('load.php');?>
				</div>
											
				<div class="col-sm-4 col-right">
					<div id="writing_textbox">
						<div class="md-form amber-textarea active-amber-textarea-2">
						<i class="fa fa-pencil fa-4" aria-hidden="true"></i>
						<label for="form24">Add Paragraph</label>
						<textarea id="form24" class="md-textarea form-control" rows="3"></textarea>
						<button type="button" class="btn float-right btn_send">Send</button>
						</div>
					</div>
					<div class="row mt-6">
						<button class="btn ml-auto btn-primary btn_save_progress">Save Progress</button>
					</div>
				</div>

			

		</div>
	</div>
	

<script src="Sortable-master/Sortable.js"></script>
<script>
		new Sortable(allParagraphs, {
			swapThreshold: 0.75,
			animation: 150,
			onUpdate: function (evt) {
				updateParaJSON(evt);
				actionRearrange();
			},
		});
</script>
<script src="js/loader.js"></script>
<script src="js/ADO_API.js"></script>
<script src="js/main.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>		

</body>

</html>