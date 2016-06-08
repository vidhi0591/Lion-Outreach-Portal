<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>
<?php
if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

	
	    $query = "SELECT name FROM account_info WHERE user_id = '".$_SESSION['user']."'";
	
	    $result = $db->query($query);
		
		$row = $result->fetch_assoc();

echo "<b>

 ".$row['name']."'s SFU Outreach Blog

 </b>
 
 <form action='blogprocessing.php' method='post'>
<br/> 
<br/> 

	New Post: 
		<br/> 
		<br/> 
		<textarea name='content' rows='8' cols='70' />
		</textarea>
		<br />
		
		
		<br/>
		<input type='submit' name='newblog' value='Post your new blog!' />
		</form>
		
		
<br/> 
<br/> 

<b>
     Your past blog entries:
	</b> 
	 		
<br/> 
---------------------------------------------------------  <br />";
	 
	
	
	$allblogs = array();
	
	$query = "SELECT content, update_time FROM all_blog_updates WHERE user_id = '".$_SESSION['user']."' ORDER BY blog_id DESC ";
	
	$result = $db->query($query);
	
	if($result){
	
	 while ($row = $result->fetch_assoc()) {
			$allblogs[] = $row;
		    }
		    $result->free(); 
	        }

      foreach ($allblogs as $row) {	

	        
	       echo "<br />";
			 echo $row['content'];	 
			  
			  
          
			 echo "<br />"; 
		     echo "<br />";
		     echo "<br />";
			 echo "<i>";
			 echo "Update time:  ";	  
			 echo $row['update_time'];
			 echo "</i>";
			 echo "<br />";
			   echo "---------------------------------------------------------  <br />" ;
	   
		   }


           }
			
	
	
	
	
	?>
	
<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>