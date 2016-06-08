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
     Technical Details as listed:
</b>
</u> 


<br/>
<br/>

During the course of this creating this website, several programming skills were used:

<br/>
<br/>

<b>Styling and Layout</b>
<br/>
- html and css for basic page layout composition and styling

<br/>
<br/>
<b>Database & mySQL</b>
<br/>
- integrated mySQL and created a backend database
<br/> 
- stored information in database including member information, highschool names, "following" connections and  blog updates
<br/>
- further back-end support account registering processing and member login validation

<br/>
<br/>
<b>Twitter API & DOM</b>
<br/>
- integrated Twitter API into website so that members can input account name and pull tweets out for other members to view in the Twitter Newsfeed
<br/>
- data was retrieved through JSON and then structured into XML which was then retrieved and then displayed

<br/>
<br/>

<b>AJAX</b>
<br/>
- AJAX was also integrated to simultaneously process back-end code for creating and displaying the newsfeed, while the website loaded first

<br/>
<br/>

<b>Integration - "Combined Newsfeed"
</b>
<br/>
- Using a similar DOM, both internal blog updates and tweets were restructured and then manipulated to create a combined newsfeed of updates from both platforms


<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	