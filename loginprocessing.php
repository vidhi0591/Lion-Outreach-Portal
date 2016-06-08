<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

<?php	
	
	
	// detect form submission	
	if (isset($_POST['login'])) {

		$email = $_POST['email'];
		$password = sha1($_POST['password']);
		$required = true;
		
		// check if email is filled and the correct format
		if (!$email || !$password ){
             echo "Email or password is missing. ";
			 $required = false;		 
			 } 
		
		if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
		 echo "Entered email is not in the correct format.";
		 $required = false;
		}

		if($required = true){
			
			$query = "SELECT user_id, email, password FROM account_info WHERE email = '$email'";
			
			$result = $db->query($query);
			
			if ($result){
			
			$row = $result->fetch_assoc(); // fetch first result
			
			$verified = $row['password'];
						
			if($password == $verified){
			
				$_SESSION['user'] = $row['user_id']; // store the userid in session variable user
				echo "You are now logged in";
				
				header('Location: allnewsfeed.php');
			
				} else {
				
			echo "Email or password incorrect. Please try again";
				
			}
			}
			}
			
			$db -> close(); 
	
	        
	} else {
	
	echo "You have been directed to this page incorrectly. Click <a href='home.php'> here </a> to return to home";
	
	}
	
	?>


<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
