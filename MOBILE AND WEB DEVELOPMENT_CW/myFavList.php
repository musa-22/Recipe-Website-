<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>

<?php

	$_SERVER["TrackingURL"] = $_SERVER["PHP_SELF"];
	Confirm_Login();
?>

<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="css/edu.css">



<title>My-Favourite-Food-List</title>

<?php include ('./backendNavBar/headerCCS.php') ?>




</head>
<body>
	<!-- start navigation -->
	<!--  -->
 

	<!-- end of navigation -->

<?php include ('./backendNavBar/headerNav.php') ?>

	<!-- Start of jumbotron -->





<?php include ('./backendNavBar/jumbotron.php') ?>





	<!--  end of Jumbotron -->




	<!-- start postVeg form -->

	<div class="container">
	
	<?php
							echo ErrorMessage();
							echo SuccessMessage();
						?>
	
		<h2 style="text-align:center">My Favourite Food Recipes</h2>
	
	<?php
// / activating search button
global $pdo;


   //$sql = "SELECT * FROM recipesmarco inner join postfav ON id=favid ORDER BY id_post desc ";


    $sql = "SELECT * FROM postfav inner join recipesmarco ON id=favid ORDER BY id_post desc ";
    
    $stm = $pdo->query($sql);


while ($meatData = $stm->fetch()) {
    
    $POSTid = $meatData["id_post"];
    
    $useNamex = $meatData["userName"];
    
    $favID = $meatData["favid"];
    
    
    $title = $meatData["title"];
    
    $image = $meatData["image"];
    
    
   // $Title = $meatData['title'];
   

?>  


	    	<div class="box">
	    	
	    
			<div class="col-md-4">
			
			
			
				<hr>
				
				<h3 class="card-title"  style="text-align:center;"> <?php  if (strlen($title)>20) {$title = substr($title,0,23)."...";} echo $title;?>
								</h3>
				
				
				<img alt="" src="Uploads/<?php echo $image;?>" width="315px;"
					height="210" Class=" thumbnail">

				<a href="fullPost.php?id=<?php echo $favID;?>"> <span
					class="btn btn-info"> READ MORE</span>
				</a>



			</div>
</div>
<?php }?>
			
</div>

		
		<br>

<!-- began footer  -->
	<?php include ('./FrontendNavBar/footer.php') ?>
	<!-- end footer  -->




</body>
</html>