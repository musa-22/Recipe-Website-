<?php require_once ("database/DB.php"); ?>
<?php
	$SEARCH = $_POST["searce"];
    
    //$SEARCH = $_GET["Search"];
		    
	$sql = "SELECT * FROM recipesmarco WHERE dae LIKE :search OR title LIKE :search OR post LIKE :search";

	$stm = $pdo->prepare($sql);
	$stm->bindValue(':search', '%' . $SEARCH . '%');
	$stm->execute();

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
					<a href="fullPostVegetra.php?id=<?php echo $POSTid?>"> <span
						class="btn btn-info"> READ MORE</span>
					</a>
				</div>
			</div>
		<?php 
	}
?>