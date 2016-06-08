<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

 <?php
 
         if (isset($_POST['view'])) {

			 //retrieve which viewing method was chosen
			 if($_POST['viewingmethod']=="name"){
			 
			//show user instructions
		    echo	 "
		     <br />
		    Please choose from registered students & alumni:
		    <br />
			<br />
		    ";

            $allnames = array();
	        $query = "SELECT user_id, name, status FROM account_info ORDER BY name ASC";
	     
		    if ($result = $db->query($query)) {
		
		    while ($row = $result->fetch_assoc()) {
			$allnames[] = $row;
		    }
		    $result->free(); 
	        } 
	
	        $db->close();

		    foreach ($allnames as $row) {			
			 echo "<a href='profile.php?user_id=".$row['user_id']."'>".$row['name']."</a>";	
		     echo "<br />";
			  echo "<br />";
		   }

             } else {
			 
			 echo	 "
		    <br />
		    Please choose from registered high schools:
		    <br />
			<br />
		    ";
			
			$allschoolnames = array();
	        $query = "SELECT school_id, highschool_name FROM all_highschools ORDER BY highschool_name ASC";
	     
		    if ($result = $db->query($query)) {
		
		    while ($row = $result->fetch_assoc()) {
			$allschoolnames[] = $row;
		    }
		    $result->free(); 
	        } 
	
	        $db->close();

		    foreach ($allschoolnames as $row) {			
			 echo "<a href='viewmembers.php?highschool=".$row['school_id']."'>".$row['highschool_name']."</a>";	
		    echo "<br />";
			  echo "<br />";
		   
		   }

		}

		
		//if the user has already chosen a high school
		} else if (isset($_GET['highschool'])) {
		
		   //retrieve the high school that the user had chosen
		    $selectedhighschool = $_GET['highschool'];
			
			//echo out instructions
			echo	 " 
		    <br />
		    Please choose from registered students & alumni:
		    <br />
			<br />
		    ";
		
		    $allnames = array();
	        $query = "SELECT user_id, name, status FROM account_info WHERE school_id = ".$selectedhighschool." ORDER BY name ASC";
	     
		    if ($result = $db->query($query)) {
		
		    while ($row = $result->fetch_assoc()) {
			$allnames[] = $row;
		    }
		    $result->free(); 
	        } 
	
	        $db->close();

		    foreach ($allnames as $row) {			
			 echo "<a href='profile.php?user_id=".$row['user_id']."'>".$row['name']."</a>";	
		    echo "<br />";
			  echo "<br />";
		   }

             }			 		 
		
		?>
	
<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>
	
	
