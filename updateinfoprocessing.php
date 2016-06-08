<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

     <?php
			
			if (isset($_POST['update'])) {
			
			$email = $_POST['email'];
			$password = sha1($_POST['password']);
		    $status = $_POST['status'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$highschoolchoose = $_POST['highschoolchoose'];
			$highschoolenter = $_POST['highschoolenter'];
			$twitter = $_POST['twitter'];
			$gradyear = $_POST['gradyear'];
			$aboutme = $_POST['aboutme'];
			
			
			if (!$email || !$password || !$status || !$name || !$phone || !$gradyear || !$aboutme ){
             echo "Please enter all fields. ";
			 
			 } else {
			 
						
			if($highschoolchoose == 0){
			
			//adding new school
			$query = "INSERT INTO all_highschools VALUES(NULL, '".$highschoolenter."')";
			
			
			$result = $db->query($query);
			
			$query = "SELECT school_id FROM all_highschools WHERE highschool_name = '".$highschoolenter."'";
			$result = $db->query($query);
			$row = $result->fetch_assoc();
			
			$highschoolchoose = $row['school_id'];
			
			$result->free();
			}
					
			$query2 = "UPDATE account_info SET  
		    email = '".$email."',
			password = '".$password."',
			status = '".$status."',
			name = '".$name."',
			phone = '".$phone."',
			school_id = '".$highschoolchoose."',
			highschool_gradyear = '".$gradyear."',
			twitter = '".$twitter."',
			about_me = '".$aboutme."'
			WHERE user_id = ".$_SESSION['user']."";
			
			
            $result2 = $db->query($query2);
			
			
            if ($result2) {
            echo "Your account information has been updated! Click <a href='myaccount.php'> here </a> to view your account.";
			
			} else {
			echo "Failed to update account information. Please try again later.";
			}
			
			
			
			
			$db->close();
			
     
	 
       }
	 
	 }
			
    ?>
	

<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>
	