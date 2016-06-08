<?php include 'opendb.php'; ?>

	</div>
	
	<div id="rightcolumn">
   <div id="rightcolumntable">
	 <div class = rightcolumn>	 
	 
	 <?php 
	 
	 if($login == false){
	 echo"
	<table>
	<form action= 'loginprocessing.php' method='post'>
		
		
			<td> Email:</td> 
			<td><input type='text' name='email' value='' /><br /> </td>
		</tr>
		<tr>
			<td>Password:</td> 
			<td><input type='password' name='password' value='' /><br /></td>
		</tr>
	
		<br />
		
		</table>
		<br />

		
		<input type='submit' name='login'value='          Login           '  />
		
		
		</form>
	    <br />
		<br />
		
         <a href='register.php'>Register as Student/Alumni</a>
		 <br />
		 <a href='home.php'>Forgot Password?</a>
		
		
		
		";
		} else {
	
	    $query = "SELECT name FROM account_info WHERE user_id = '".$_SESSION['user']."'";
	
	    $result = $db->query($query);
		
		$row = $result->fetch_assoc();
		
		
		
		echo "Welcome back ".$row['name']."!";
		
		echo "<br /> <br />
		
		<a href=updateinfo.php> Update Account Info </a>
		
		<br />
		
		<br />
		
		<form action= 'logout.php' method='post'>
		
		<input type='submit' name='logout' value='          Logout           '  />
		
		";
		
		}
		
		$db->close();
    ?>
	
    </div>

	    </div>
	</div>
    </div>
 
	
	</div>