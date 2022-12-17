<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<?php

  
  
  $PostIdFormUrl = $_GET['id'];
  Confirm_Login();

if (isset($_POST["Submit"])) {
    
    $RecipesTitle = $_POST["Title"];
    
    
    $PostMeat = $_POST["meatN"];
    
    $PostVegan = $_POST["veganN"];
    
    $PostVegetr = $_POST["vegetarianN"];
    
    $PostText = $_POST["Post"];
    
    $Image = $_FILES["image"]["name"]; // for image we  have to use file super global // the second brackets is to accept argument name of images
    
    $target = "Uploads/" . basename($_FILES["image"]["name"]);
    
    date_default_timezone_set("Europe/London");
    $CurrentTime = time();
    $DateTime = strftime("%B-%m-%d  %H:%M:%S", $CurrentTime);
    
    if (empty($RecipesTitle)) {
        
        $_SESSION["ErrorMessage"] = "Title Required  ";
        Redirect_to("Edit.php");
    } elseif (strlen($RecipesTitle) < 10) {
        
        $_SESSION["ErrorMessage"] = "Title must be greater than 10 characters";
        Redirect_to("Edit.php");
    } elseif (strlen($PostText) > 49999) {
        
        $_SESSION["ErrorMessage"] = "Post Description must be less than 2000 characters";
        
        Redirect_to("Edit.php");
    } else {
        
        
        // create query to update our data ?
        global $pdo;
        
        if (!empty( $_FILES["image"]["name"])){
            
            $sql = "UPDATE recipesmarco
            
    SET title='$RecipesTitle', meat='$PostMeat', vegan='$PostVegan', vegetarian='$PostVegetr',
    
             image='$Image', post='$PostText' WHERE id='$PostIdFormUrl'";
            
            
        } else {
            
            
            
            $sql = "UPDATE recipesmarco
            
    SET title='$RecipesTitle', meat='$PostMeat', vegan='$PostVegan', vegetarian='$PostVegetr',
    post='$PostText' WHERE id='$PostIdFormUrl'";
            
            
        }
        
        
        $Execute =$pdo->query($sql);
        

        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        
     
  //    var_dump($Execute);
        
        
        if ($Execute) {
            $_SESSION["SuccessMessage"] = " Your Post has updated ?";
            Redirect_to("profile.php");
        } else {
            
            $_SESSION["ErrorMessage"] = " Something went wrong. try again!";
            Redirect_to("Edit.php");
        }
    }
}

?>






<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="css/edu.css">



<title>Edit-Vegan-Recipes</title>


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
		<h3 style="text-align: center;">Edit - Post - Recipes</h3>



		<form action="Edit.php?id=<?php echo $PostIdFormUrl;?>" method="post"
			<?php
echo htmlspecialchars($_SERVER["PHP_SELF"])?>
			enctype="multipart/form-data">

			<label for="fname">Title</label> <input type="text" id="fname"
				name="Title" placeholder="Your title.."
				value="<?php echo $titleEidt;?>"> <label for="fname">Meat</label> <input
				type="text" id="meat" name="meatN"
				placeholder="Type only meat if your recipes about meat?"
				value="<?php echo $MeaEdit;?>"> <label for="fname">Vegan</label> <input
				type="text" id="vegan" name="veganN"
				placeholder="Type only Vegan if your recipes about Vegan?"
				value="<?php echo $VeganEdit;?>"> <label for="fname">Vegetarian</label>
			<input type="text" id="vegeta" name="vegetarianN"
				placeholder="Type only vegetarian if your recipes about vegetarian"
				value="<?php echo $kKindOfRecipesEdit;?>"> <span class="FieldInfo">image</span><br>
			<br> <img alt="" src="Uploads/<?php echo $imageEdit;?>" width="140px"
				height="70px"><br>
			<br> <input type="file" id="lname" name="image" placeholder=".."
				value=""><br> <label for="Post">Post-Your-Recipe</label>
			<textarea id="Post" name="Post" placeholder="Write something.."
				style="height: 200px"> <?php echo $postEdit;?> </textarea>

			<input type="submit" value="Submit" name="Submit">

		</form>
	</div>
	<br>

	<!-- end of postVeg form -->
	<!-- start footer  -->

<?php include ('./FrontendNavBar/footer.php') ?>

<!-- end footer  -->


</body>
</html>