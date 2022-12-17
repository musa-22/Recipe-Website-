<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<?php 

$_SERVER["TrackingURL"]=$_SERVER["PHP_SELF"];

Confirm_Login();

?>


<!DOCTYPE html>
<html>
<head>


<link rel="stylesheet" href="css/edu.css">



<title>Post-Meat</title>


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
		<div class="md-5" style="position: relative; left: 0px;">
			<!--Search-bar-->
			<div class="well">
				<h4>Search by title here</h4>

				<form action="postMea.php">

					<div class="input-group" style="margin-top: 4px;">
						<input type="text" name="Search" id="search_custom" class="form-control"> <span
							class="input-group-btn">
							<button class="btn btn-primary" name="SearchButton">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>


					</div>
				</form>
			</div>

		</div>

	</div>
<br>

	<div class="container" style="background: #72727d;">
	<?php echo '<section id="ravi_data">';?>
<table class="table table-hover ">
  <thead class="thead-dark">
  
    <tr>
      <th scope="col" >ID</th>
       <th scope="col" >Date&Time</th>
      <th scope="col" >Title</th>
      <th scope="col" >Type-Of-Food</th>
      <th scope="col" >Image</th>
       <th scope="col" >Post</th>
       <th scope="col" >Edit</th>
            <th scope="col" >Delete</th>
                 <th scope="col" >View</th>
    </tr>
    
  </thead>
  
	
	
	<?php
// / activating search button
global $pdo;

if (isset($_GET["SearchButton"])) {
    
    $SEARCH = $_GET["Search"];
    
    $sql = "SELECT * FROM recipesmarco

       WHERE title LIKE :search
";
    
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':search', '%' . $SEARCH . '%');
    $stm->execute();
    
    // the default SQL query
} 

else {
    $xxx = "Meat";
    $aa = "meat";
    $sql = "SELECT * FROM  recipesmarco WHERE meat = '$xxx' OR meat = '$aa'  ORDER BY id desc ";
    
    $stm = $pdo->query($sql);
}

while ($meatData = $stm->fetch()) {
    
    $id = $meatData["id"];
    
    $dateTime = $meatData["dae"];
    
    $title = $meatData["title"];
    
    $kKindOfRecipes = $meatData["meat"];
     
    $image = $meatData["image"];
    
    $post = $meatData["post"];
    
    ?>
	    
	    
  <tbody>
   
   
    <tr>
      <th scope="row">
      
      
      <?php echo $id ?> 
      
      
       </th>
      
      
      <td > <?php 
      if (strlen($dateTime)>11) {$dateTime = substr($dateTime,0,11)."..";}
      
      echo $dateTime;
      
      
      ?>
        </td>
        
        
        
      <td > <?php 
      
      if (strlen($title)>11) {$title = substr($title,0,11)."..";}
      
      echo $title;
      ?></td>
      
      
      
      
      
      <td > <?php 
      
      
      
      if (strlen($title)>11) {$kKindOfRecipes = substr($kKindOfRecipes,0,11)."..";}
      
      echo $kKindOfRecipes;
      
      
      ?>
      
      
      </td>
      
      
      
      
       <td > 
       <img src="Uploads/<?php echo $image;?> " width="170px;" height="50">
      
      
      </td>
      
      
        <td > <?php 
      
      
      
      if (strlen($post)>11) {$post = substr($post,0,11)."..";}
      
      echo $post;
      
      
      ?>
      
      
      </td>
      
      
       <td > <a href="Edit.php?id= <?php echo $id;?>"> <span class="btn btn-warning"> Edit-Post  </span></a>
      
      </td>
      
      
      
  
        <td > <a href="dele.php?id=<?php echo $id;?>"> <span class="btn btn-danger"> Delete-Post </span></a>
        
        
        <td > <a href="fullPost.php?id=<?php  echo $id; ?>"> <span class="btn btn-primary"> View-Post  </span></a>
        
        
      
       
      </td>
      
      
    </tr>
   
  </tbody>
  
  <?php }?>
</table><?php echo '</section>'; ?>


</div>

<br>


	<!-- end of postVeg form -->
	
	<!-- start footer  -->

	
	
	<?php include ('./FrontendNavBar/footer.php') ?>
	


<!-- end footer  -->
	
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).on('keyup','#search_custom',function(){
      var searce = $(this).val();
      $.ajax({
            type: 'POST',
            url: 'postVegan_s.php',
            data: {"searce":searce},
            beforeSend: function () {
              
            },
            success: function (responce) {
              
               $("#ravi_data").html(responce);

            }
        });
    });
  </script>

</body>
</html>