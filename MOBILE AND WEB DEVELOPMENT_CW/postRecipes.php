<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>

<?php

	$_SERVER["TrackingURL"] = $_SERVER["PHP_SELF"];
	Confirm_Login();
?>


<?php 


if(isset($_POST["Submit"])){
    
    $RecipesTitle = $_POST["title"];
    
    $PostMeat = $_POST["meatN"];
    
    $PostVegan = $_POST["veganN"];
    
    $PostVegetr = $_POST["vegetarianN"];
    
    $PostText = $_POST["Post"];
  
    $Image = $_FILES["image"]["name"]; // for image we have to use file super global // the second brackets is to accept argument name of images
    
    $target = "Uploads/".basename($_FILES["image"]["name"]);
    
    
    date_default_timezone_set("Europe/London");
   $CurrentTime = time();
   $DateTime = strftime("%B-%m-%d  %H:%M:%S", $CurrentTime);
    
   if (empty($RecipesTitle)) {
       
       $_SESSION["ErrorMessage"] = "Title Required  ";
        Redirect_to("postRecipes.php");
    
    
 } elseif (strlen($RecipesTitle) < 10) {
        
     $_SESSION["ErrorMessage"] = " Title must be greater than 10 characters";
            Redirect_to("postRecipes.php");
            
            
            
            
 } elseif (strlen($PostText) > 49999) {
               
     $_SESSION["ErrorMessage"] = "Post Description must be less than 2000 characters";
               
     Redirect_to("postRecipes.php");

 } else  {
    
   global $pdo;
   
   $sql = "INSERT INTO recipesmarco(dae,title,meat,vegan,vegetarian,image,post)

  VALUES(:dateTime,:postTitle,:postMea,:postVeganism,:postVegetarianism,:imagess,:postT)";
   
   $stmt = $pdo->prepare($sql);
   
   $stmt->bindValue(':dateTime',$DateTime);
   
   $stmt->bindValue(':postTitle',$RecipesTitle);
   
   $stmt->bindValue(':postMea',$PostMeat);
   
   $stmt->bindValue(':postVeganism',$PostVegan);
   
   $stmt->bindValue(':postVegetarianism',$PostVegetr);
   
   $stmt->bindValue(':postT',$PostText);
   
   $stmt->bindValue(':imagess',$Image);
   
     
   $Execute = $stmt->execute();
   
   
   move_uploaded_file($_FILES["image"]["tmp_name"],$target);
    
   if ($Execute) {
        $_SESSION["SuccessMessage"] = " Post with id: " . $pdo->lastInsertId() . " Added Successfully";
        Redirect_to("postRecipes.php");
   
   } else {
           
       $_SESSION["ErrorMessage"] = " Something went wrong. try again!";
       Redirect_to("postRecipes.php");
   }
 }
 
}

?>






<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="css/edu.css">



<title>Post-Vegetarian</title>


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
<?php echo ErrorMessage(); echo SuccessMessage();
?>

<!-- validation form -->
 <h3 style="text-align: center;" > Post - Recipes </h3>
 
 
 
  <form action="postRecipes.php" method="post" <?php  
        echo htmlspecialchars($_SERVER["PHP_SELF"])?> enctype="multipart/form-data">
 
    <label for="fname">Title</label>
    <input type="text" id="fname" name="title" placeholder="Your title..">
    
      <label for="fname">Meat</label>
    <input type="text" id="meat" name="meatN" placeholder="Type only meat if your recipes about meat?">
    
      <label for="fname">Vegan</label>
      <input type="text" id="vegan" name="veganN" placeholder="Type only Vegan if your recipes about Vegan?">
    
    <label for="fname">Vegetarian</label>
      <input type="text" id="vegeta" name="vegetarianN" placeholder="Type only vegetarian if your recipes about vegetarian">
    

    <label for="image">image</label>
    
    <input type="file" id="lname" name="image" placeholder="Your last name..">

<br>
    <label for="Post">Post-Your-Recipe</label>
    <textarea id="Post" name="Post"  placeholder="Write something.." style="height:200px"></textarea>

    <input  type="submit" value="Submit" name="Submit">
    
  </form>
</div>
<br>
	
	<!-- end of postVeg form -->
<!-- start footer  -->

<?php include ('./FrontendNavBar/footer.php') ?>

<!-- end footer  -->


</body>
</html>