<?php  require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>


<?php  $AddToFav = $_SESSION["userId"]; ?>

<?php

if (isset($_POST["Submit"])) {
    
    if (! empty($AddToFav)) {
        $pid = $_POST['postId'];
        $title = $_POST['title'];
        $imgdata = $_POST['imgdata'];
        $dateTime = $_POST['dateTime'];
        $postdata = $_POST['postdata'];
        $sql = "select * from postfav where favid=$pid ";
        $smt = $pdo->query($sql);
        $listData = $smt->fetch();
        $id_post = $listData['id_post'];
        if (! empty($id_post)) {
            $sql = "UPDATE postfav SET userName=$AddToFav, favid=$pid where id_post='$id_post' ";
            
            $Execute = $pdo->query($sql);
        } else {
            $sql = "insert into postfav (userName,favid) values($AddToFav,$pid)";
            
            $Execute = $pdo->query($sql);
        }
        
        if ($Execute) {
            
            $_SESSION["SuccessMessage"] = " Added to your favourite list ?";
            header("Location:myFavList.php");
        } else {
            
            $_SESSION["ErrorMessage"] = " Something went wrong. try again!";
            header("Location:myFavList.php");
        }
    } else {
        
        $_SESSION["ErrorMessage"] = " Please Sign in to save your recipe!";
        
        echo "<script>window.location.href='login.php';</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>

<title>Full-Post</title>
<!-- Include Bootstrap -->
<link rel="stylesheet" href="css/edu.css">

<?php include ('./backendNavBar/headerCCS.php') ?>


</head>
<body>
	<!-- start navigation -->
	<!--  -->
 
 <?php include ('./FrontendNavBar/headerNav.php') ?>
	<!-- end of navigation -->



	<!-- Start of jumbotron -->





<?php include ('./backendNavBar/jumbotron.php') ?>





	<!--  end of Jumbotron -->




	<!-- full post start -->

	<div class="container col-10">

<?php if(!empty($AddToFav)){ echo ErrorMessage();  echo $_SESSION["SuccessMessage"];}?>

	
	<?php
$PostIdFormUrl = $_GET['id'];
?>
			<div class="col-md-10">

			<form action="fullPost.php?id=<?php echo $PostIdFormUrl;?>"
				name="frm" enctype="multipart/form-data" method="post">




				<input type="submit" value="Save Recipe" name="Submit"
					class="btn btn-primary">
		
		</div>

	</div>




	<div class="container col-12">
		<div class="col-sm-12">
	
	<?php
// / activating search button

$sql = "SELECT * FROM recipesmarco WHERE id='$PostIdFormUrl' ";

$stm = $pdo->query($sql);

while ($meatData = $stm->fetch()) {
    
    $id = $meatData["id"];
    
    $dateTime = $meatData["dae"];
    
    $title = $meatData["title"];
    
    $kKindOfRecipes = $meatData["vegetarian"];
    
    $image = $meatData["image"];
    
    $post = $meatData["post"];
    
    ?>
	    
	    		
               
               <h3 class="card-title" align="center"> <?php  echo $title;?> </h3>
			<div align="center">
				<img src="Uploads/<?php echo $image;?>" width="450px;" height="210"
					Class=" thumbnail">
			</div>

			<h5 class="card-title"> <?php   echo $dateTime; ?> </h5>

			<hr>



			<p class="card-text"> <?php echo nl2br($post);?> </p>

			<input type="hidden" name="postId"
				value="<?php echo $PostIdFormUrl; ?>"> <input type="hidden"
				name="title" value="<?php echo $title; ?>"> <input type="hidden"
				name="imgdata" value="<?php echo "Uploads/".$image;?>"> <input
				type="hidden" name="dateTime" value="<?php echo $dateTime; ?>"> <input
				type="hidden" name="postdata" value="<?php echo nl2br($post); ?>">



		</div>
			
			<?php }?>
			
			
			
			<!-- creating a pagination -->

	</div>


	</form>

	<br>



	<!-- footer -->

<?php include ('./FrontendNavBar/footer.php') ?>

</body>
</html>