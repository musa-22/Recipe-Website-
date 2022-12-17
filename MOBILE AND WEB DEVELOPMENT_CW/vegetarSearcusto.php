<?php require_once ("database/DB.php"); ?>
<?php
	$SEARCH = $_POST["searce"];
    
    $sql = "SELECT * FROM recipesmarco

       WHERE dae LIKE :search

OR title LIKE :search

OR post LIKE :search";
    
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':search', '%' . $SEARCH . '%');
    $stm->execute();

    while ($meatData = $stm->fetch()) 
    {
    
	    $POSTid = $meatData["id"];
	    
	    $dateTime = $meatData["dae"];
	    
	    $title = $meatData["title"];

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

					<a href="fullPostVegetra.php?id=<?php echo $POSTid?>">
						<span class="btn btn-info"> READ MORE</span>
					</a>
				</div>
			</div>
		<?php 
	}
?>