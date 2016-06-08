<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>


<?php 

if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

$user_id = $_SESSION['user'];
			
		    $info = array();
	        $query = "SELECT user_id, name, email, status, phone, school_id, highschool_gradyear, twitter, about_me FROM account_info WHERE user_id = ".$user_id." ";
	     
		    if ($result = $db->query($query)) {
		
		    $row = $result->fetch_assoc();
		
			
		    $result->free(); 
	        } 
	
	        $name = $row['name'];
			$email = $row['email'];
			if($row['status'] = 'current'){
			$status = 'Current Student';
			} else if ($row['status'] = 'alumni'){
			$status = 'Alumni';
			} else if ($row['status'] = 'prospective'){
			$status = 'Prospective Student';
			}
			
			$phone = $row['phone'];
			$school_id = $row['school_id'];
			$highschool_gradyear = $row['highschool_gradyear'];
			$twitter = $row['twitter'];
			$about_me = $row['about_me'];
	
			$query = "SELECT highschool_name FROM all_highschools WHERE school_id = ".$school_id." ";
	     
		    if ($result = $db->query($query)) {
		
		    $row2 = $result->fetch_assoc();
			
		    $result->free(); 
	        } 
	
			$highschool_name = $row2['highschool_name'];
			
			
				

			echo	 " 
		    <br />
			<b>
		    ".$name."'s Profile Information
		    </b>
			<br />
			<br />
		    
			
			<table>
		
		<tr><td> Status: ".$status." </td><td>
		<tr><td> Email: ".$email." </td><td>
		<tr><td> Phone No.: ".$phone." </td><td>
		<tr><td> Highschool: ".$highschool_name." </td><td>
		<tr><td> Grad Year: ".$highschool_gradyear." </td><td>
		<tr><td> Twitter Account: ".$twitter." </td><td>
		<tr><td> About me: ".$about_me." </td><td>

		</table>
        </br>
		
             ";
			 
			 
		
		echo "
		 
		 <form action='updateinfo.php' method='post'>
    
		<input type='submit' name='updateinfo' value='Click here to update your information' />
		</form>	 
			 ";
		
			 
		
   echo "			 

  
    <br/> 
    <b>

     ".$name."'s SFU blog entries:
	 
	 </b>	
    <br/> ---------------------------------------------------------  <br />";	 		 
		
	$allblogs = array();
	
	$query = "SELECT content, update_time FROM all_blog_updates WHERE user_id = '".$user_id."' ORDER BY blog_id DESC ";
	
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
			 echo "<img src='https://www.sfu.ca/content/sfu/clf/branding/_jcr_content/main_content/textimage/image.img.jpg/1375138118331.jpg' width='22' height='14'>";
			 echo "Update time:  ";	  
			 echo $row['update_time'];
			 echo "</i>";
			 echo "<br />";
			   echo "---------------------------------------------------------  <br />" ;
	   
		   }


           
			
			
	$db->close();

	// Require codebird
	require_once('codebird-php/src/codebird.php');
	// Require authentication parameters
	require_once('twitter_config.php');
	
	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($access_token, $access_token_secret);
	
	$reply = $cb->oauth2_token();
	$bearer_token = $reply->access_token;
	
	// App authentication
	\Codebird\Codebird::setBearerToken($bearer_token);
		
	// Create query
	$params = array(
		'screen_name' => $twitter,	
		'count' => 5,
	
	);

     
		
	// Make the REST call
	$res = (array) $cb->statuses_userTimeline($params);
	// Convert results to an associative array
	$data = json_decode(json_encode($res), true);
		
	// Optionally, store results in a file
	file_put_contents("single_mu.json", json_encode($res));
	
	echo "			 
    
	<br/> 
    <br/> 
    <br/> 
    <b>

    ".$name."'s (".$twitter.") 5 Most Recent Tweets <img src='https://g.twimg.com/Twitter_logo_blue.png' width='22' height='18'> :
	 
	 </b>	
   ";	 		
	
	/*echo "<img src=\"".$data['0']['user']['profile_image_url']."\"/>"; //getting the profile image
	echo "Name: ".$data['0']['user']['name']."<br/>"; //getting the username
	echo "Web: ".$data['0']['user']['url']."<br/>"; //getting the web site address
	echo "Location: ".$data['0']['user']['location']."<br/>"; //user location
	echo "Updates: ".$data['0']['user']['statuses_count']."<br/>"; //number of updates
	echo "Follower: ".$data['0']['user']['followers_count']."<br/>"; //number of followers
	echo "Following: ".$data['0']['user']['friends_count']."<br/>"; // following
	echo "Description: ".$data['0']['user']['description']."<br/>"; //user description */
	

	foreach ($data as $item){
		echo '<br/> --------------------------------------------------------- <br/>';
	echo '<br/>';
	
			echo $item['text'];
			
			if(!empty($item['text'])){
			 
			$datestring = strtotime($item['created_at']);
			
            $date = date('Y-m-d H:i:s', strtotime($item['created_at']));

			
			echo '<br/>';
			echo '<br/>';
			echo '<br/>'; 
			echo "<i>";
			echo "<img src='https://g.twimg.com/Twitter_logo_blue.png' width='22' height='18'>";
			echo "Update time:  ";
			 echo $date;
			 
			 echo "</i>";
			
			if(!empty($item['entities']['media']['0']['media_url'])){
				echo "<img src=\"".$item['entities']['media']['0']['media_url']."\" width=\"200\" height=\"200\"/>"; //getting the profile image
			}
		 }
		;
	}	
	
	}
	
 

?>
 

	
<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>
	