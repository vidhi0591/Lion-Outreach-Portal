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
    About the Author/Creator:
</b>
</u>

<br/>
<br/>
<img src='https://scontent-a-sea.xx.fbcdn.net/hphotos-ash2/t1.0-9/373781_10150993158370198_1047129508_n.jpg' width='181' height='266'> 
<br/>
<h2> 
Enoch Chi Him Ng

</h2>

<br/>
Vancouver, Canada 
<br/>
<i>
Simon Fraser University Joint Major in Business and Interactive Arts & Technology       
</i>

<br/>

<br/>
I am an aspiring individual with a passion for mobile computing and character design.
I am also a Business student with SFU's Beedie School of Business.
I plan to graduate and find a career in mobile computing and mobile app design.



<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	