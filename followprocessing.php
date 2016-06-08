<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

     <?php
			
			if (isset($_GET['follow_id']))  {
			
				$follow_id = $_GET['follow_id'];
			
			
			if($follow_id) {
				
			$query = "INSERT INTO follow_connections (user_id, user_id_followed) VALUES('".$_SESSION['user']."','".$follow_id."')";

            $result = $db->query($query);
			
			$query = "SELECT name FROM account_info WHERE user_id = ".$follow_id." ";
	     
			$result2 = $db->query($query);
			
			$row = $result2->fetch_assoc();

            if ($result) {
			
            echo "You are now following <a href='profile.php?user_id=".$follow_id."'> ".$row['name']." </a>. Click <a href='newsfeed.php'> here </a> to go to your newsfeed.";
				
			} else {
			echo "You were unable to follow <a href='profile.php?user_id=".$follow_id."'> ".$row['name']." </a>. Please try again later";


			}
			
			} else {
			echo "You have been directed to this page incorrectly. Click <a href='home.php'> here </a> to go back to home.";
			}
		
			}
			?>

	

<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>			