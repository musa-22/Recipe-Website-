<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>

<?php

if (isset($_SESSION["userId"])) {
    echo "<script>window.location.href='profile.php';</script>";
}

if (isset($_POST['Submitt'])) {
    
    $Emai = $_POST["Email"];
    
    $Password = $_POST["Password"];
    
    if (empty($Emai) || empty($Password)) {
        
        $_SESSION['ErrorMessage'] = "You can not submit an empty information";
        echo "<script>window.location.href='login.php';</script>";
    } else {
        
        $Found_Account = Login_Attempt($Emai, $Password);
        if ($Found_Account) {
            
            $_SESSION["userId"] = $Found_Account["id"];
            $_SESSION["emI"] = $Found_Account["emi"];
            
            $_SESSION["Ename"] = $Found_Account["ename"];
            $_SESSION["SuccessMessage"] = " Welcome Back " . $_SESSION["Ename"] . "!";
            
            if (isset($_SESSION["TrackingURL"])) {
                
                Redirect_to($_SESSION["TrackingURL"]);
            } else {
                
                $_SESSION["ErrorMessage"] = " Welcome Back  ";
                
                echo "<script>window.location.href='profile.php';</script>";
            }
        } else {
            
            $_SESSION["ErrorMessage"] = " Incorrect Email/Password!";
            Redirect_to("login.php");
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


	<!--Login users -->
	<div class="container">

		<div class="row">

			<div class="col-md-offset-5 col-md-3">
			<?php

echo ErrorMessage();
echo SuccessMessage();
?>
				<div class="form-login">



					<form action="login.php" method="post">
						<label> Email</label> <input type="Email" id="email" name="Email"
							class="form-control input-sm" placeholder="Email Address"
							required="required" /> <label> Password</label> <input
							type="Password" id="userPassword" name="Password"
							class="form-control input-sm chat-input" placeholder="Password" />
						</br>
						<div class="wrapper">

							<button class="btn btn-lg btn-primary btn-block" type="submit"
								name="Submitt">Login</button>

						</div>
					</form>
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