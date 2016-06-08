<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

     <?php
			
			if (isset($_POST['register'])) {
			
			$email = $_POST['email'];
			$password = sha1($_POST['password']);
		    $status = $_POST['status'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$highschoolchoose = $_POST['highschoolchoose'];
			$highschoolenter = $_POST['highschoolenter'];
			$gradyear = $_POST['gradyear'];
			$twitter = $_POST['twitter'];
			$aboutme = $_POST['aboutme'];
			
			
			if (!$email || !$password || !$status || !$name || !$phone || !$gradyear || !$aboutme ){
             echo "Please enter all fields. ";
			 
			 } else {
			 
						
			if($highschoolchoose == 0){
			
			//adding new school
			$query = "INSERT INTO all_highschools VALUES(NULL, '".$highschoolenter."')";
			
			
			$result = $db->query($query);
			
			/*
			if($result){
			echo "Your highschool has been added to our database.";
		    }
			*/
			
			
			$query = "SELECT school_id FROM all_highschools WHERE highschool_name = '".$highschoolenter."'";
			$result = $db->query($query);
			$row = $result->fetch_assoc();
			
			
			$highschoolchoose = $row['school_id'];

			
			
			$result->free();
			}
					
			$query = "INSERT INTO account_info (email, password, status, name, phone, school_id, highschool_gradyear, twitter, about_me ) VALUES('".$email."','".$password."','".$status."','".$name."','".$phone."','".$highschoolchoose."','".$gradyear."','".$twitter."','$aboutme')";

			
            $result = $db->query($query);
			

            if ($result) {
            echo "Your new account has been created! Click <a href='myaccount.php'> here </a> to view your account.";
			
			$query = "SELECT user_id FROM account_info WHERE email = '".$email."'";
			
			$result = $db->query($query);
			
			if ($result){
			
			$row = $result->fetch_assoc(); // fetch first result
			
				$_SESSION['user'] = $row['user_id']; // store the userid in session variable user
				
				$login = true;
			}
			
            } else {
			echo "Failed to create a new account. Please try again later.";
			}
			
			
			
			
			$db->close();
			
     
	 
       }
	 
	 }
			
    ?>
	

<?php include 'rightcolumn.php'; ?>


		
<?php include 'footer.php'; ?>
	
		
