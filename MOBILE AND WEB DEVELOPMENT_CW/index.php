<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/edu.css">
		<title>Home-Page</title>
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
		<!-- start postVeg form  style="background-color:black;"-->
		<div class="container " style="background-color:white;" >
			<div class="row" >
				<div class="col-sm-8">
					<?php
						// activating search button
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
				        		$DifferentPostSho = ($Page * 2) - 2;
				    		}
				    		$sql = "SELECT * FROM  recipesmarco    ORDER BY id desc LIMIT  $DifferentPostSho,2";
				    
				    		$stm = $pdo->query($sql);
						} 
						else 
						{
				    		$sql = "SELECT * FROM  recipesmarco  ORDER BY id desc LIMIT 0,2";
				    
				    		$stm = $pdo->query($sql);
						}
						echo '<section id="ravi_data">';
						while ($meatData = $stm->fetch()) 
						{
				    
				    		$POSTid = $meatData["id"];
				    
				    		$dateTime = $meatData["dae"];
				    
				    		$title = $meatData["title"];
				    
						 	//   $kKindOfRecipes = $meatData["meat"];
						    
						 	//   $kKindOfRecipes2 = $meatData["vegan"];
						    
						 	//   $kKindOfRecipes3 = $meatData["vegetarian"];
						     
						    $image = $meatData["image"];
						    
						    $post = $meatData["post"];
						    
				    	?>
						<div class="card" style="width: 46rem;">
							<div class="card-body">
								<h3 class="card-title"  style="text-align:center;"> <?php  if (strlen($title)>20) {$title = substr($title,0,23)."...";} echo $title;?>
								</h3>
								<br>
								<img class="card-img-top"  alt="" src="Uploads/<?php echo $image;?>" width="468px;"height="313" Class=" thumbnail">
								<h5 class="card-title"> written on <?php   echo $dateTime; ?> </h5>
								<hr>
								<p class="card-text"   ><?php if (strlen($post)>150) {$post= substr($post,0,200)."...";} echo $post;?> </p>
								<a href="fullPost.php?id=<?php echo $POSTid?>"> <span
									class="btn btn-info"> READ MORE</span>
								</a>
							</div>
						</div>
						<?php 
						}
					?>	
					<?php echo '</section>'; ?>
					<!-- creating a pagination -->
					<!--pagination  Start -->
					<nav style="padding: 25px 140px;">
						<ul class="pagination pagination-lg"  style="text-align:center;">
							<!-- backward button -->
							<?php 
								if (isset($Page)) 
								{
									if ($Page>1) 
									{
										?>
											<li class="page-item" > 
												<a href="index.php?page=<?php echo $Page-1;?>" class="page-link">&laquo;
												</a>
											</li>
										<?php 
									}
								}
							?>
							<?php 
								global $pdo;
								$sql = "SELECT COUNT(*) FROM recipesmarco  ";

								$stmt = $pdo->query($sql);

								$RowPagination=$stmt->fetch();

								$TotalPost=array_shift($RowPagination);

								//echo $TotalPost."<br>";


								$PostPagination = $TotalPost / 4 ;
								 
								$PostPagination = ceil($PostPagination);

								//echo $PostPagination;
								for ($i = 1; $i <=$PostPagination; $i++) 
								{
									?>
										<li class="page-item" > <a href="index.php?page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
									<?php 
								}
							?>
							<!-- Forward Button Start -->
							<?php 
								if (isset($Page)&&!empty($Page)) 
								{
									if ($Page+1<=$PostPagination) 
									{
										?>
											<li class="page-item" > <a href="index.php?page=<?php echo $Page+1;?>" class="page-link">&raquo;</a></li>
										<?php 
									}
								}
							?>
							<!-- Forward Button End -->
						</ul>
					</nav>
				</div>
				<div class="col-sm-4" style="padding-bottom: 29px;">
				<!--Search-bar-->
					<div class="">
						<form action="index.php">
							<div class="input-group" style="margin-top: 2px;">
								<input type="text" id="search_custom" name="Search" class="form-control" placeholder="Search Here"> <span
									class="input-group-btn">
									<button class="btn btn-primary" name="SearchButton">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</span>
							</div>
						</form>
					</div>
					<br>
					<iframe width="390" height="315" src="https://www.youtube.com/embed/6pUX4rwFNa0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<br>
				<br>
				<iframe width="390" height="315" src="https://www.youtube.com/embed/cqcVT-X2hXs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<br>
				<br>
				<h3> Our Restaurant Location</h3>
				
				
				<br>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1189.5431775703285!2d-2.9630849452537142!3d53.3953951234148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487b20e23a03774b%3A0xdb891644d286a112!2sSelborne%20Cl%2C%20Liverpool%20L8%202XU!5e0!3m2!1sen!2suk!4v1618957454902!5m2!1sen!2suk" width="390" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
				</div>
		</div>
		
		<!-- end of postVeg form -->
		
		<?php include ('./FrontendNavBar/footer.php') ?>
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script type="text/javascript">
			$(document).on('keyup','#search_custom',function(){
				var searce = $(this).val();
				$.ajax({
			        type: 'POST',
			        url: 'searcecustome.php',
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