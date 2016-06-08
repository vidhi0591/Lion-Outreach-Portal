<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>
<?php
if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

echo "Here's your blog. Add a new post here";
	}
	
	?>
	
<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>