<?php include 'header.php'; ?>
<?php include_once 'session.php'; ?>

<?php



if (isset($_SESSION['user'])) {
	unset($_SESSION['user']);
}

 session_destroy();

 echo "You are now logged out. Click <a href='home.php'> here </a> to return home";
 
 $login = false;
 
?>


<?php include 'rightcolumn.php'; ?>		

<?php include 'footer.php'; ?>
	

