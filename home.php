<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

<?php
	if($_SERVER["HTTPS"] != "on") {
		header("Location: https://". $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		exit;
	}
?>
<b>
    Welcome to the SIAT Student & Alumni Outreach Page!
</b>

<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	