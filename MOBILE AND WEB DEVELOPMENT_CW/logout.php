
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>

<?php 

$_SESSION["userId"]=NULL;
$_SESSION["emI"]=NULL;
$_SESSION["Ename"]=NULL;

session_destroy();

Redirect_to("login.php");
   

    ?>
