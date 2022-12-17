 <?php require_once("database/DB.php"); ?>

<?php 
function Redirect_to($New_Location){
    
    header("Location:".$New_Location);
    exit;
}


function CheckEmailExistsOrNot($Email){
    
    global $pdo;
    
    $sql  = "SELECT emi FROM regis WHERE emi=:eMi";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt -> bindValue(':eMi',$Email);
    
    $stmt -> execute();
    
    $Result = $stmt ->rowCount();
    
    
    if ($Result==1) {
        
        return true;
        
        
    } else {
        return false;
    
    }
    
}
    

function Login_Attempt($Email,$Password){
    
    global $pdo;
    
    $sql = "SELECT * FROM regis WHERE emi=:emI AND passw=:confipassw LIMIT 1";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt ->bindValue(':emI',$Email);
    
    $stmt ->bindValue(':confipassw',$Password);
    
    $stmt->execute();
    
    $Result = $stmt->rowCount();
    
    if ($Result==1) {
        
        return $Found_Account=$stmt->fetch();

    } else {
        
    return null;
        
    }
}
    
    function Confirm_Login(){
        
        if (isset($_SESSION["userId"])) {
            return true;
            
        } else {
            
            $_SESSION["ErrorMessage"] = " Login Required !";
            
            Redirect_to("login.php");
        }
        
    }
     


?>
