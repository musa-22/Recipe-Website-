<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/edu.css">
			<title>Vegan-Recipes</title>
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
		<div class="container">
			<div class="md-5" style="position: relative; left: 0px;">
				<!--Search-bar-->
				<div class="well">
					<h4>Search here</h4>
					<form action="FrontVegan.php">
						<div class="input-group" style="margin-top: 25px;">
							<input type="text" id="search_custom" name="Search" class="form-control"> <span
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
		<!-- start postVeg form -->
		<div class="container">
			<?php
			// / activating search button
			global $pdo;

			if (isset($_GET["SearchButton"])) 
			{
		    
		    	$SEARCH = $_GET["Search"];
		    
		    	$sql = "SELECT * FROM recipesmarco WHERE dae LIKE :search OR title LIKE :search OR post LIKE :search";
		    
		    	$stm = $pdo->prepare($sql);
		    	$stm->bindValue(':search', '%' . $SEARCH . '%');
		    	$stm->execute();
		    
		    	// the default SQL query
			} 
			elseif (isset($_GET["page"])) 
			{
		    
		    	$Page = $_GET["page"];
		    
		    	if ($Page == 0 || $Page < 1) 
		    	{
		        
		        	$DifferentPostSho = 0;
		    	} 
		    	else 
		    	{
		        
		        	$DifferentPostSho = ($Page * 3) - 3;
		    	}
		    
			    $xxx = "Vegan";
			    $aa = "vegan";
			    $sql = "SELECT * FROM  recipesmarco WHERE vegan = '$xxx' OR vegan = '$aa' ORDER BY id desc LIMIT  $DifferentPostSho,3";
			    
			    $stm = $pdo->query($sql);
			} 
			else 
			{
			    $xxx = "Vegan";
			    $aa = "vegan";
			    $sql = "SELECT * FROM  recipesmarco WHERE vegan = '$xxx' OR vegan = '$aa'  ORDER BY id desc LIMIT 0,3";
			    
			    $stm = $pdo->query($sql);
			}
			echo '<section id="ravi_data">';
			while ($meatData = $stm->fetch()) 
			{
		    
			    $POSTid = $meatData["id"];
			    
			    $dateTime = $meatData["dae"];
			    
			    $title = $meatData["title"];
			    
			    $kKindOfRecipes = $meatData["vegan"];
			     
			    $image = $meatData["image"];
			    
			    $post = $meatData["post"];
		    
			    ?>
			    	<div class="box">
						<div class="col-md-4">
							<hr>
							<h3 class="card-title"> <?php  if (strlen($title)>20) {$title = substr($title,0,23)."...";} echo $title;?> </h3>
							<img alt="" src="Uploads/<?php echo $image;?>" width="315px;"
								height="210" Class=" thumbnail">
							<h5 class="card-title"> written on <?php   echo $dateTime; ?> </h5>
							<hr>
							<p class="card-text"><?php if (strlen($post)>150) {$post= substr($post,0,200)."...";} echo $post;?> </p>
							<a href="fullPost.php?id=<?php echo $POSTid?>"> <span
								class="btn btn-info"> READ MORE</span>
							</a>
						</div>
					</div>
				<?php 
			}
			echo '</section>';
			?>
			<!-- creating a pagination -->
			<!--pagination  Start -->
			<nav style="padding: 25px;">
				<ul class="pagination pagination-lg">
				<!-- backward button -->
					<?php 

					if (isset($Page)) {
					    
					    
					    if ($Page>1) {

					?>

					<li class="page-item" > <a href="FrontVegan.php?page=<?php echo $Page-1;?>" class="page-link">&laquo;</a></li>

					<?php }}?>



					<?php 
					global $pdo;

					$xxx = "Vegan";
					$aa = "vegan";

					$sql = "SELECT COUNT(*) FROM recipesmarco WHERE vegan = '$xxx' OR vegan= '$aa' ";

					$stmt = $pdo->query($sql);

					$RowPagination=$stmt->fetch();

					$TotalPost=array_shift($RowPagination);

					//echo $TotalPost."<br>";


					$PostPagination = $TotalPost / 3;
					 
					$PostPagination = ceil($PostPagination);

					//echo $PostPagination;


					for ($i = 1; $i <=$PostPagination; $i++) {


					?>


					<li class="page-item" > <a href="FrontVegan.php?page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
					<?php }?>

					<!-- Forward Button Start -->

					<?php 


					if (isset($Page)&&!empty($Page)) {

				    
				    	if ($Page+1<=$PostPagination) {
				        

					?>

					<li class="page-item" > <a href="FrontVegan.php?page=<?php echo $Page+1;?>" class="page-link">&raquo;</a></li>

					<?php }}?>
					<!-- Forward Button End -->
				</ul>

			</nav>
		</div>
		<!-- end of postVeg form -->
		
		<?php include ('./FrontendNavBar/footer.php') ?>
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).on('keyup','#search_custom',function(){
				var searce = $(this).val();
				$.ajax({
			        type: 'POST',
			        url: 'frontvegan_s.php',
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