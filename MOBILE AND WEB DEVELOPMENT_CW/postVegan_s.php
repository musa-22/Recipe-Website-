<?php require_once ("database/DB.php"); ?>
<?php
	$SEARCH = $_POST["searce"];
    
   
      
      $sql = "SELECT * FROM recipesmarco WHERE title LIKE :search";
      
      $stm = $pdo->prepare($sql);
      $stm->bindValue(':search', '%' . $SEARCH . '%');
      $stm->execute();
      ?>
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

	    while ($meatData = $stm->fetch()) 
	    {
	      
	      $id = $meatData["id"];
	      
	      $dateTime = $meatData["dae"];
	      
	      $title = $meatData["title"];
	      
	      $kKindOfRecipes = $meatData["vegan"];
	       
	      $image = $meatData["image"];
	      
	      $post = $meatData["post"];
	      
	      ?>
	        <tbody>
	          <tr>
	            <th scope="row"><?php echo $id ?></th>
	            
	            
	            <td> <?php 
	            	if (strlen($dateTime)>11) {$dateTime = substr($dateTime,0,11)."..";}
	            
	            	echo $dateTime;	            
	            	?>
	            </td>
	            <td > <?php 
	            
	            	if (strlen($title)>11) {$title = substr($title,0,11)."..";}
	            
	            	echo $title;
	            	?>
	            		
	            </td>
	            <td> 
	            	<?php 
	            
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
	             <td > <a href="Edit.php?id= <?php echo $id;?>"> 
	             	<span class="btn btn-warning"> Edit-Post  </span></a>
	            
	            </td>
	            <td > <a href="dele.php?id=<?php echo $id;?>"> <span class="btn btn-danger"> Delete-Post </span></a></td>
	            <td > <a href=""> <span class="btn btn-danger"> View-Post  </span></a>
	             
	            </td>
	            
	            
	          </tr>
	        
	        </tbody>
	      <?php 
	    }
	    ?></table><?php
?>