
<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<?php

	$_SERVER["TrackingURL"] = $_SERVER["PHP_SELF"];
	Confirm_Login();
?>

<?php

	global $pdo;

	$PostIdFormUrl = $_SESSION["userId"];

    $sql = "SELECT * FROM regis WHERE id='$PostIdFormUrl' ";

    $stm = $pdo->query($sql);

  	while ($profile = $stm->fetch()) 
  	{
    
	    // $id = $editPost["id"];
	    
	    $namePro = $profile["ename"];
	    
	    $emailPro = $profile["emi"];
	    
	    $aDdre= $profile["addre"];
	    
	    $imagePro = $profile["image"];
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/edu.css">
	<title>Profile</title>
	<?php include ('./backendNavBar/headerCCS.php') ?>
</head>
<body>
	<!-- start navigation -->
	<!--  -->
 	<?php include ('./backendNavBar/headerNav.php') ?>

	<!-- end of navigation -->
	<!-- Start of jumbotron -->
	<?php include ('./backendNavBar/jumbotron.php') ?>
	<!--  end of Jumbotron -->

	<style>
		body {
			margin-top: 20px;
			background: #f3f3f3;
		}
		.card.user-card {
			border-top: none;
			-webkit-box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px
				rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
			box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px
				rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
			-webkit-transition: all 150ms linear;
			transition: all 150ms linear;
		}

		.card {
			border-radius: 5px;
			-webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
			border: none;
			margin-bottom: 30px;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		.card .card-header {
			background-color: transparent;
			border-bottom: none;
			padding: 25px;
		}

		.card .card-header h5 {
			margin-bottom: 0;
			color: #222;
			font-size: 14px;
			font-weight: 600;
			display: inline-block;
			margin-right: 10px;
			line-height: 1.4;
		}

		.card .card-header+.card-block, .card .card-header+.card-block-big {
			padding-top: 0;
		}

		.user-card .card-block {
			text-align: center;
		}

		.card .card-block {
			padding: 25px;
		}

		.user-card .card-block .user-image {
			position: relative;
			margin: 0 auto;
			display: inline-block;
			padding: 5px;
			width: 110px;
			height: 110px;
		}

		.user-card .card-block .user-image img {
			z-index: 20;
			position: absolute;
			top: 5px;
			left: 5px;
			width: 100px;
			height: 100px;
		}

		.img-radius {
			border-radius: 50%;
		}

		.f-w-600 {
			font-weight: 600;
		}

		.m-b-10 {
			margin-bottom: 10px;
		}

		.m-t-25 {
			margin-top: 25px;
		}

		.m-t-15 {
			margin-top: 15px;
		}

		.card .card-block p {
			line-height: 1.4;
		}

		.text-muted {
			color: #919aa3 !important;
		}

		.user-card .card-block .activity-leval li.active {
			background-color: #2ed8b6;
		}

		.user-card .card-block .activity-leval li {
			display: inline-block;
			width: 15%;
			height: 4px;
			margin: 0 3px;
			background-color: #ccc;
		}

		.user-card .card-block .counter-block {
			color: #fff;
		}

		.bg-c-blue {
			background: linear-gradient(45deg, #4099ff, #73b4ff);
		}

		.bg-c-green {
			background: linear-gradient(45deg, #2ed8b6, #59e0c5);
		}

		.bg-c-yellow {
			background: linear-gradient(45deg, #FFB64D, #ffcb80);
		}

		.bg-c-pink {
			background: linear-gradient(45deg, #FF5370, #ff869a);
		}

		.m-t-10 {
			margin-top: 10px;
		}

		.p-20 {
			padding: 20px;
		}

		.user-card .card-block .user-social-link i {
			font-size: 30px;
		}

		.text-facebook {
			color: #3B5997;
		}

		.text-twitter {
			color: #42C0FB;
		}

		.text-dribbble {
			color: #EC4A89;
		}

		.user-card .card-block .user-image:before {
			bottom: 0;
			border-bottom-left-radius: 50px;
			border-bottom-right-radius: 50px;
		}

		.user-card .card-block .user-image:after, .user-card .card-block .user-image:before
			{
			content: "";
			width: 100%;
			height: 48%;
			border: 2px solid #4099ff;
			position: absolute;
			left: 0;
			z-index: 10;
		}

		.user-card .card-block .user-image:after {
			top: 0;
			border-top-left-radius: 50px;
			border-top-right-radius: 50px;
		}

		.user-card .card-block .user-image:after, .user-card .card-block .user-image:before
			{
			content: "";
			width: 100%;
			height: 48%;
			border: 2px solid #4099ff;
			position: absolute;
			left: 0;
			z-index: 10;
		}
	</style>
	<!-- start postVeg form -->
	<div class="container">
		<!-- validation form -->
		<div class="col-md-12">
			<div class="card user-card">
				<div class="card-header">
					<div class="card-block">
						<div id="SuccessMessage"></div>
						<?php
							echo ErrorMessage();
							echo SuccessMessage();
						?>
						<div class="">
							<img alt="" id="upload-img" src="Uploads/<?php echo $imagePro;?>" width="140px" height="70px">
						</div>
						<h6 class="f-w-600 m-t-25 m-b-10">Name</h6>
							<div id="name_"><?php echo $namePro;?></div>
						<h6 class="f-w-600 m-t-25 m-b-10">Email</h6>
							<div id="email_"><?php echo  $emailPro;?></div>
						<h6 class="f-w-600 m-t-25 m-b-10"> Address </h6>
							<div id="address_"><?php echo  $aDdre;?></div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-5 col-md-3">
				<div class="form-login">
					<div id="error"></div>
					<form action="profile.php?id=<?php echo $PostIdFormUrl;?>" method="post" <?php echo htmlspecialchars($_SERVER["PHP_SELF"])?> enctype="multipart/form-data">

						<input type="text" id="nam" name="name" class="form-control input-sm" placeholder="Name" /> <br> 
						<input type="Email" id="email" name="Email" class="form-control input-sm" placeholder="Email Address" /> <br>
						<input type="text" id="emai" name="Address" class="form-control input-sm" placeholder=" Address" /> </br>
						<input type="file" id="imag" name="image" class="form-control input-sm" placeholder="new image" /> <br>
						<div class="wrapper">
							<button class="btn btn-lg btn-primary btn-block" type="button" id="edit_profile" name="Submitt">Edit-Data</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br>
	<!-- end of postVeg form -->

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).on('click','#edit_profile',function(){
			
			var name = $('#nam').val();
			var Email = $('#email').val();
			var Address = $('#emai').val();
			//var image = $('#imag').val();
			var image = $('#imag').prop('files')[0];   
    		
    		var form_data = new FormData();                  
    		form_data.append('name', name);
    		form_data.append('Email', Email);
    		form_data.append('Address', Address);
    		form_data.append('image', image);
			//alert(Email);
			$.ajax({
		        url: 'profileedit.php',
		        dataType: 'text', 
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',
		       	beforeSend: function () {
		        	
		        },
		        success: function (responce) {
		        	//console.log(responce);
		        	var json = JSON.parse(responce);
		        	//alert(json);
		        	if (json.status == 'image') 
		        	{
		        		$("#SuccessMessage").html('<div class="alert alert-success">'+json.SuccessMessage+'</div>');
		        		$("#name_").html(json.name);
		        		$("#email_").html(json.email);
		        		$("#address_").html(json.address);
		        		$("#upload-img").attr('src',json.img);
		           	}
		        	else if(json.status == 'success')
		        	{   
		        		$("#SuccessMessage").html('<div class="alert alert-success">'+json.SuccessMessage+'</div>');
		        		$("#name_").html(json.name);
		        		$("#email_").html(json.email);
		        		$("#address_").html(json.address);
		        	}
		        	else
		        	{
		        		$("#SuccessMessage").html('<div class="alert alert-danger">'+json.ErrorMessage+'</div>');
		        	}
		        	//alert(responce);
		        	//$("#error").html('<div class="alert alert-danger"><strong>Opps!</strong>'+responce+'</div>');

		        }
		    });
		});
	</script>
	
	<br>
	<!-- began footer  -->
	<?php include ('./FrontendNavBar/footer.php') ?>
	<!-- end footer  -->
</body>
</html>