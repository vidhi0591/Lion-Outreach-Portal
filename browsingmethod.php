<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>
	
<br /><b>	
   Category to view by:
   </b>
   <br />
	<br />
	<form action="viewmembers.php" method="post">
	<select name="viewingmethod">		
    <option value="name">Name of Member</option>
    <option value="highschool">Highschool</option>
	</select>
		
	<input type="submit" name="view" value="Proceed" />
	</form>

<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>
	
	