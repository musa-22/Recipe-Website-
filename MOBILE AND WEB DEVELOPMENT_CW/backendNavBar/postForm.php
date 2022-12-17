
<div class="container">
<?php echo ErrorMessage(); echo SuccessMessage();
?>
 <h3 style="text-align: center;" > Post - Vegetarian </h3>
  <form action="postRecipes.php" method="post" enctype="multipart/form-data">
 
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

    <input type="submit" value="Submit" name="Submit">
    
  </form>
</div>
	