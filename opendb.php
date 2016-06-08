<?php

   @ $db = new mysqli('localhost','enochn','enochn','enochn');
			
   if(mysqli_connect_errno()) {
	  die($db->connect_errno);
    }


?>