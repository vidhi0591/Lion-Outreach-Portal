<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>
<?php
	if($_SERVER["HTTPS"] != "on") {
		header("Location: https://". $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
		exit;
	}
?>
<br/>
<u>
<b>
    	This website is licensed under the Gnu General Public License Version 3.]
	For more information please see: https://www.gnu.org/licenses/gpl.html
</b>
</u> 


<br/>
<br/>



<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	
