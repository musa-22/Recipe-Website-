<?php require_once ("database/DB.php"); ?>
<?php require_once ("Functions/functions.php");?>
<?php require_once ("Session/Sessions.php");?>
<?php
	$id = $_SESSION["userId"];
	
	if (isset($_POST)) 
	{
    	
	    $UserName = $_POST["name"];
	    $emaiL = $_POST["Email"];
	    $Addresss = $_POST["Address"];
	    $Image = '';
	    if(!empty($_FILES["image"]))
	    {
	    	$Image = $_FILES["image"]["name"];
	    	$target = "Uploads/" . basename($_FILES["image"]["name"]);
	    	move_uploaded_file($_FILES["image"]["tmp_name"], $target);
	    }
	    
    
	    if (strlen($UserName) > 35) 
	    {
	       
	        echo json_encode(array('status'=>'false','ErrorMessage'=>'Name must be less then 10 character ?'));
	      
	    } 
	    elseif (strlen($Addresss) > 55) 
	    {
	        
	        
	        echo json_encode(array('status'=>'false','ErrorMessage'=>'Phone Number must be less then 14 digit?'));
	       
	    } 
	    else 
	    {
	    	if (! empty($_FILES["image"]["name"])) 
	    	{
	            $sql = "UPDATE regis
	            
	    		SET ename='$UserName', emi='$emaiL',addre='$Addresss', image='$Image' WHERE id='$id'";
        	} 
        	else 
        	{
            	$sql = "UPDATE regis SET ename='$UserName', emi='$emaiL',addre='$Addresss' WHERE id='$id'";
            }
        	$Execute = $pdo->query($sql);
        
       
        
        	if ($Execute) 
        	{
            
	            
	            if(!empty($_FILES["image"]))
	            {
	            	echo json_encode(array('status'=>'image','SuccessMessage'=>'Your data has updated ?','name'=>$UserName,'email'=>$emaiL,'address'=>$Addresss,'img'=>'Uploads/'.$Image));
	            }
	            else
	            {
	            	echo json_encode(array('status'=>'success','SuccessMessage'=>'Your data has updated ?','name'=>$UserName,'email'=>$emaiL,'address'=>$Addresss));
	            }
	           
	        } 
	        else 
	        {
            	
            	echo json_encode(array('status'=>'false','ErrorMessage'=>'Something went wrong. try again!'));
            	
        	}
    	}
	}