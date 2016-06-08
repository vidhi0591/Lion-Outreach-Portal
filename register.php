<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>

   <form action="accountregisterprocessing.php" method="post">
		<b>
		<u>
		<br />
		Account Information
		<br />
		</u>
		</b>
		<br />
		<table>
		<tr><td> Email: </td><td> <input type="text" name="email" value="" /> </td></tr>
		<tr><td> Password: </td><td><input type="password" name="password" value="" /></td></tr>	
        <tr><td> Re-Enter Password: </td><td><input type="password" name="password2" value="" /></td></tr>
        
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
		<tr><td> Name: </td><td><input type="text" name="name" value="" /></td></tr>
		<tr><td> Status: </td><td><select name="status" value="" />
		
		<option value="alumni"> Alumni
		</option>
		<option value="current"> Current Student
		</option>
		<option value="prospective"> Prospective Student
		</option>
		
		</select></td></tr>
		<tr><td>Phone No: </td><td><input type="text" name="phone" value="" /></td></tr>
		
		<tr><td>
		Highschool: </td><td>
		
		<select name="highschoolchoose" >	
		
		<?php 
         $allhighschools = array();
	     $query = "SELECT school_id, highschool_name FROM all_highschools ORDER BY highschool_name ASC";
	     
		if ($result = $db->query($query)) {
		
		while ($row = $result->fetch_assoc()) {
			$allhighschools[] = $row;
		}
		$result->free(); 
	      } 
	
	     $db->close();

		foreach ($allhighschools as $row) {
			
			echo "<option value=".$row['school_id'].">".$row['highschool_name']."</option>";		
		}
	    ?>

		<option value="0">--Enter your own Highschool--</option>
		 </td></tr>
         </select>
		 
		<tr><td>or enter Highschool name: </td><td><input type="text" name="highschoolenter" value="" /></td></tr>
		
		
		
		<tr><td>
		Highschool Year of Graduation: </td><td>
		<select name="gradyear">		
		<?php 
         for ($i = 2013; $i> 1979; $i--){
	      echo "<option value=".$i.">".$i."</option>";
         } 
		?>
		 </td></tr>
         </select>
		 
        
		
          <tr><td>Twitter Account (Optional): </td><td><input type="text" name="twitter" value="" /></td></tr>		
		
		 
		 
		 </table>
		 
		<br/>
		About Me: 
		<br/> 
		<br/> 
		<textarea name="aboutme" rows="5" cols="50" />
		</textarea>
		<br />
		
		
		<br/>
		<input type="submit" name="register" value="Register" />
		</form>


<?php include 'rightcolumn.php'; ?>
		
<?php include 'footer.php'; ?>
	

