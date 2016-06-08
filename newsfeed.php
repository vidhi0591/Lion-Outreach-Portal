<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>
<?php 

if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

echo "Here's the newsfeed of the bloggers you have followed! <br /><br />";

 echo "---------------------------------------------------------  <br />" ;
	
	 $allfollowed = array();
	
	 $query1 = "SELECT user_id_followed FROM follow_connections WHERE user_id = '".$_SESSION['user']."'";
	
	 $result1 = $db->query($query1);
		
	if($result1){
	
	 while ($row1 = $result1->fetch_assoc()) {
			$allfollowed[] = $row1;
		    }
		 
	        }
      
    	$allblogs = array();	
		
		
      foreach ($allfollowed as $each) {	
               
	    $query2 = "SELECT blog_id, user_id FROM all_blog_updates WHERE user_id = '".$each['user_id_followed']."'";
	
	    $result2 = $db->query($query2);
		
		if($result2){
		while ($row2 = $result2->fetch_assoc()) {
			$allblogs[] = $row2;
		    } 
	        }
		}
		
		arsort($allblogs);
		
		foreach($allblogs as $blog){
		
		$query3 = "SELECT content, update_time FROM all_blog_updates WHERE blog_id = '".$blog['blog_id']."' ORDER BY blog_id DESC ";
	
		$result3 = $db->query($query3);
		
		if($result3){
		while ($row3 = $result3->fetch_assoc()) {
			
			
		$query4 = "SELECT user_id, name FROM account_info WHERE user_id = '".$blog['user_id']."'";
	
		$result4 = $db->query($query4);	
		
		$row4 = $result4->fetch_assoc();	
			
		     echo "<b>";
			 echo "<a href='profile.php?user_id=".$row4['user_id']."'>".$row4['name']."</a>";
			 echo " </b> posted on mySFU blog: ";
			 echo " <br /><br />";
			 echo $row3['content'];	 
			  
			  
          
			 echo "<br />"; 
		     echo "<br />";
		     echo "<br />";
			 echo "<i> <img src='https://www.sfu.ca/content/sfu/clf/branding/_jcr_content/main_content/textimage/image.img.jpg/1375138118331.jpg' width='22' height='14'> ";
			 echo "Update time:  ";	  
			 echo $row3['update_time'];
			 echo "</i>";
			 echo "<br />";
			   echo "---------------------------------------------------------  <br />" ;
	   
		   }
			} 
	        }
		
		
		
	
	
	
	
	
	
	
	}
	
	?>



<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	