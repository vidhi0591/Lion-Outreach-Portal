<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>


<?php


	        $query = "SELECT user_id, name, email, password, status, phone, school_id, highschool_gradyear, twitter, about_me FROM account_info WHERE user_id = ".$_SESSION['user']." ";
	     
		    if ($result = $db->query($query)) {
		
		    $row = $result->fetch_assoc();
			

			echo " Update your account information here.";

			
			echo "
			
 <form action='updateinfoprocessing.php' method='post'>
		<b>
		<u>
		<br />
		Account Information
		<br />
		</u>
		</b>
		<br />
		<table>
		<tr><td> Email: </td><td> <input type='text' name='email' value='".$row['email']."' /> </td></tr>
		<tr><td> Password: </td><td><input type='password' name='password' value='' /></td></tr>	
       
	    </table>
		<br />
		<br />
		<br />
		<b>
		<u>
		User Information
		<br />
		</b>
		</u>
		<br />
		
		<table>
		<tr><td> Name: </td><td><input type='text' name='name' value='".$row['name']."'/></td></tr>
		<tr><td> Status: </td><td><select name='status' selected='".$row['status']."' />
		
		<option value='alumni'> Alumni
		</option>
		<option value='current'> Current Student
		</option>
		<option value='prospective'> Prospective Student
		</option>
		
		</select></td></tr>
		<tr><td>Phone No: </td><td><input type='text' name='phone' value='".$row['phone']."' /></td></tr>
		
		<tr><td>
		Highschool: </td><td>";
		
		$query2 = "SELECT highschool_name FROM all_highschools where school_id = ".$row['school_id']." ";
		$result2 = $db->query($query2);
		$row2 = $result2->fetch_assoc();
		
		
		echo"
		
		<select name='highschoolchoose' value = ".$row2['highschool_name']." >	
		";
		
	
         $allhighschools = array();
	     $query = 'SELECT school_id, highschool_name FROM all_highschools ORDER BY highschool_name ASC';
	     
		if ($result = $db->query($query)) {
		
		while ($row3 = $result->fetch_assoc()) {
			$allhighschools[] = $row3;
		}
		$result->free(); 
	      } 
	
	     $db->close();

		foreach ($allhighschools as $row3) {
			
			echo "<option value=".$row3['school_id'].">".$row3['highschool_name']."</option>";		
		}
	   

		echo"
		<option value='0'>--Enter your own Highschool--</option>
		 </td></tr>
         </select>
		 
		<tr><td>or enter Highschool name: </td><td><input type='text' name='highschoolenter' value='' /></td></tr>
		
		
		
		<tr><td>
		Highschool Year of Graduation: </td><td>
		<select name='gradyear' value = ".$row['highschool_gradyear'].">		
		";
		
		
		
         for ($i = 2013; $i> 1979; $i--){
	      echo "<option value=".$i.">".$i."</option>";
         } 
		
		echo"
		<tr><td> Twitter Account (Optional): </td><td><input type='text' name='twitter' value='".$row['twitter']."'/></td></tr>
		";
		
		
		echo"
		 </td></tr>
         </select>
		 </table>
		 <br />
		 
		 
		
		About Me: 
		<br/> 
		<br/> 
		<textarea name='aboutme' rows='5' cols='50' />";
		echo $row['about_me'];echo"</textarea>
		<br />
		
		
		<br/>
		<input type='submit' name='update' value='Update Information' />
		</form>
         ";

		 }
		 ?>
		 
	


<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	