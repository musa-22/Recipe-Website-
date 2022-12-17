<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<?php



$_SERVER["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login();
  
  $PostIdFormUrl = $_GET['id'];
  
 
  global $pdo;
  
  $sql = "SELECT * FROM recipesmarco WHERE id='$PostIdFormUrl' ";
  
  $stm = $pdo->query($sql);
  
  while ($editPost = $stm->fetch()) {
      
      // $id = $editPost["id"];
      
      $titleEidt = $editPost["title"];
      
      $MeaEdit = $editPost["meat"];
      
      $VeganEdit = $editPost["vegan"];
      
      $kKindOfRecipesEdit = $editPost["vegetarian"];
      
      $imageEdit = $editPost["image"];
      
      $postEdit = $editPost["post"];
  }
  
  
  
  

if (isset($_POST["Submit"])) {
    
    
        // create query to delete our data ?
        
        global $pdo;
      
            
            $sql = "DELETE FROM recipesmarco WHERE id='$PostIdFormUrl'";
                    
        
        $Execute =$pdo->query($sql);
        

        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        
    
        
        if ($Execute) {
            $_SESSION["SuccessMessage"] = " Your Post has been deleted ?";
            Redirect_to("profile.php");
        } else {
            
            $_SESSION["ErrorMessage"] = " Something went wrong. try again!";
            Redirect_to("dele.php");
        }
    }


?>






<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="css/edu.css">



<title>Delete-Post</title>


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




	<!-- start postVeg form -->





	<div class="container">
<?php

echo ErrorMessage();
echo SuccessMessage();

global $pdo;

$sql = "SELECT * FROM recipesmarco WHERE id='$PostIdFormUrl' ";

$stm = $pdo->query($sql);

while ($editPost = $stm->fetch()) {
    
    // $id = $editPost["id"];
    
    $titleEidt = $editPost["title"];
    
    $MeaEdit = $editPost["meat"];
    
    $VeganEdit = $editPost["vegan"];
    
    $kKindOfRecipesEdit = $editPost["vegetarian"];
    
    $imageEdit = $editPost["image"];
    
    $postEdit = $editPost["post"];
}

?>





<!-- validation form -->
		<h3 style="text-align: center;">Delete - Post</h3>



		<form action="dele.php?id=<?php echo $PostIdFormUrl;?>" method="post"
			<?php
echo htmlspecialchars($_SERVER["PHP_SELF"])?>
			enctype="multipart/form-data">

			<label  for="fname">Title</label> 
			
			<input disabled type="text" id="fname"
				name="Title" placeholder="Your title.."
				value="<?php echo $titleEidt;?>"> <label for="fname">Meat</label> <input disabled
				type="text" id="meat" name="meatN"
				placeholder="Type only meat if your recipes about meat?"
				
				value="<?php echo $MeaEdit;?>"> <label for="fname">Vegan</label> <input disabled
				type="text" id="vegan" name="veganN"
				placeholder="Type only Vegan if your recipes about Vegan?"
				value="<?php echo $VeganEdit;?>">
				
				 <label for="fname">Vegetarian</label>
				
			<input disabled type="text" id="vegeta" name="vegetarianN"
				placeholder="Type only vegetarian if your recipes about vegetarian"
				value="<?php echo $kKindOfRecipesEdit;?>"> <span class="FieldInfo">image</span><br>
			<br> 
			
			<img alt="" disabled src="Uploads/<?php echo $imageEdit;?>" width="140px"
				height="70px"><br>
				
				
			<br> 
			
			<input disabled type="file" id="lname" name="image" placeholder=".."
				value=""><br> <label for="Post">Post-Your-Recipe</label>
				
				
			<textarea disabled id="Post" name="Post" placeholder="Write something.."
				style="height: 200px"> <?php echo $postEdit;?> </textarea>

			<input type="submit" value="Delete Post" name="Submit">

		</form>
	</div>
	<br>

	<!-- end of postVeg form -->
	<!-- start footer  -->

<?php include ('./FrontendNavBar/footer.php') ?>

<!-- end footer  -->


</body>
</html>