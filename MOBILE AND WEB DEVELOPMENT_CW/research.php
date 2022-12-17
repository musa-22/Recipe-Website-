
<?php

include('database/DB.php');

$country = '';
$query = "SELECT title FROM recipesmarco ORDER BY id ASC";
$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
foreach($result as $row)
{
    $country .= '<option value="'.$row['title'].'">'.$row['title'].'</option>';
    
    
    
}

?>

<html>
 <head>
 
  <title> Research - View </title>
<link rel="stylesheet" href="css/edu.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  
 

  
  
 </head>
 <body>
 
  <?php include ('./FrontendNavBar/headerNav.php') ?>
	<!-- end of navigation -->



	<!-- Start of jumbotron -->





<?php include ('./backendNavBar/jumbotron.php') ?>

 
 
 
  <div class="container box">
   <h3 align="center">  Research & Filter Result </h3>
   <br />
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
     <div class="form-group">
     
     
      <select name="filter_gender" id="filter_gender" class="form-control" required>
       <option value="">Select-Food</option>
       <option value="meat">Meat</option>
       <option value="vegan">Vegan</option>
       <option value="vegetarian">vegetarian</option>
      </select>
      
      
     </div>
     <div class="form-group">
      <select name="filter_country" id="filter_country" class="form-control" required>
       <option value="">Select Title</option>
       <?php echo $country; ?>
      </select>
     </div>
     <div class="form-group" align="center">
      <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
     </div>
    </div>
    <div class="col-md-4"></div>
   </div>
   <div class="table-responsive">
    <table id="customer_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th width="10%">Date&Time</th>
       <th width="15%">Title</th>
       <th width="5%">Meat</th>
       <th width="5%">Vegan</th>
       <th width="2%">Vegetarian</th>
       <th width="15%">ID</th>
       
      </tr>
     </thead>
    </table>
    <br />
    <br />
    <br />
    
   </div>
  </div>
 </body>
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fill_datatable();
  
  function fill_datatable(filter_gender = '', filter_country = '')
  {
   var dataTable = $('#customer_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "searching" : false,
    "ajax" : {
     url:"fetch.php",
     type:"POST",
     data:{
      filter_gender:filter_gender, filter_country:filter_country
     }
    }
   });
  }
  
  $('#filter').click(function(){
   var filter_gender = $('#filter_gender').val();
   var filter_country = $('#filter_country').val();
   if(filter_gender != '' && filter_country != '')
   {
    $('#customer_data').DataTable().destroy();
    fill_datatable(filter_gender, filter_country);
   }
   else
   {
    alert('Select Both filter option');
    $('#customer_data').DataTable().destroy();
    fill_datatable();
   }
  });
  
  
 });

 
 
</script>

<br>
	
	
	
	
	<!-- end of postVeg form -->
	
	<?php include ('./FrontendNavBar/footer.php') ?>
	

</body>
</html>
