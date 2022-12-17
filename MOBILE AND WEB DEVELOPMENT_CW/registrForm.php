<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>




<?php 

global $pdo;


if(isset($_POST["Submit"])) {
    
    if(!empty($_POST["firstname"])&&!empty($_POST["lastname"])) {
         $TFirstName = $_POST["firstname"];
        
        $TLastName = $_POST["lastname"];
        
        $TEmail = $_POST["email"];
        
        $Tpasswor = $_POST["password"];
        
        $TConfrimPass= $_POST["passwordconfirmation"];
        
        global $pdo;
        
        
        if (empty($TFirstName) ||empty($TLastName)||empty($TEmail) ||empty($Tpasswor)||empty($Tpasswor)||empty($TConfrimPass)) {
            $_SESSION["ErrorMessage"] = "ALL fields must be filled out";
            
            Redirect_to("registrForm.php");
           }
           
           elseif (strlen($Tpasswor) < 6) {
               
           
       $_SESSION["ErrorMessage"] = "Password must be more than 5 characters";
                
           Redirect_to("registrForm.php");
    
 } elseif (strlen($Tpasswor !== $TConfrimPass)) {
                    
         $_SESSION["ErrorMessage"] = " Password and confirm password did not match?";
                    
     
         Redirect_to("registrForm.php");
       
     }elseif (CheckEmailExistsOrNot($TEmail)) {
             
             $_SESSION["ErrorMessage"] = " please login you already have an account with us!";
            Redirect_to("registrForm.php");
            
   
     }
                 else {
        
        
        $sql = "INSERT INTO regis(ename,esurname,emi,passw)
            
        VALUES(:EnAame,:EsurName,:eMi,:passWordd)"; // Dummy NAMES TO PREVENT SQL INJECTION
        
        //
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':EnAame',$TFirstName);
        
        $stmt->bindValue(':EsurName',$TLastName);
        
        $stmt->bindValue(':eMi',$TEmail);
       
        $stmt->bindValue(':passWordd',$Tpasswor);
        
       
        
        $Execute = $stmt->execute();
        
        if ($Execute) {
        
            $_SESSION["SuccessMessage"] = " Welcome to our World's Recipes Web site";
            Redirect_to("registrForm.php");
        } else {
            
            $_SESSION["ErrorMessage"] = " Something went wrong. try again!";
            Redirect_to("registrForm.php");
 }
                 }
    }
    }
    
?>


<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="css/edu.css">




<title>Sign-Up</title>


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

<?php echo ErrorMessage(); echo SuccessMessage();
?>
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title"style="position: center;"> Registration form</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form action="registrForm.php" method="post">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					
			                <input type="text" name="firstname" id="firstname" 
			                class="form-control input-sm" placeholder="First Name"
			                 required="required">
			                
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lastname" id="last_name" class="form-control input-sm" placeholder="Last Name" required="required">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address">
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="passwordconfirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" name="Submit" value="Register" class="btn btn-info btn-block">
			    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

<br>

	<!-- start footer  -->

<?php include ('./FrontendNavBar/footer.php') ?>

<!-- end footer  -->
	
</body>
</html>