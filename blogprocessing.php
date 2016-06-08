<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

     <?php
			
			if (isset($_POST['newblog']))  {
			
				$content = $_POST['content'];
				
				if($content) {
				
			$query = "INSERT INTO all_blog_updates (user_id, content) VALUES('".$_SESSION['user']."','".$content."')";

			
            $result = $db->query($query);
			

            if ($result) {
            echo "Your new post has been updated to your blog! Click <a href='blog.php'> here </a> to view your blog.";
				
			} else {
			echo "Your blog could not be updated at this time. Please try again later.";


			}
			
			} else {
			echo "You have not entered anything into the blog.  Click <a href='blog.php'> here </a> to go back to your blog.";
			}
			
			}
			?>

	

<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>			