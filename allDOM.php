<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php

// create doctype

$dom = new DOMDocument("1.0");

// display document in browser as plain text 
// for readability purposes
header("Content-Type: text/plain");

// create root element
$allupdates = $dom->createElement("allupdates");
$dom->appendChild($allupdates);

//access database

$allfollowed = array();
	
 $allfollowed = array();
	
	 $query1 = "SELECT user_id_followed FROM follow_connections WHERE user_id = '".$_SESSION['user']."'";
	
	 $result1 = $db->query($query1);
		
	if($result1){
	
	 while ($row1 = $result1->fetch_assoc()) {
			$allfollowed[] = $row1;
		    }
		 
	        }
      
    	$allblogs = array();	
		
		
      foreach ($allfollowed as $each) {	
               
	    $query2 = "SELECT blog_id, user_id FROM all_blog_updates WHERE user_id = '".$each['user_id_followed']."'";
	
	    $result2 = $db->query($query2);
		
		if($result2){
		while ($row2 = $result2->fetch_assoc()) {
			$allblogs[] = $row2;
		    } 
	        }
		}
		
		arsort($allblogs);
		
		foreach($allblogs as $blog){
		
		$query3 = "SELECT content, update_time FROM all_blog_updates WHERE blog_id = '".$blog['blog_id']."' ORDER BY blog_id DESC ";
	
		$result3 = $db->query($query3);
		
		if($result3){
		while ($row3 = $result3->fetch_assoc()) {
			
			
		$query4 = "SELECT user_id, name FROM account_info WHERE user_id = '".$blog['user_id']."'";
	
		$result4 = $db->query($query4);	
		
		$row4 = $result4->fetch_assoc();	
		
	$update = $dom->createElement("update");
    $allupdates->appendChild($update);
		
	//id
	 $id = $dom->createElement("user_id");
     $update->appendChild($id);

     $idv = $dom->createTextNode($row4['user_id']);
     $id->appendChild($idv); 
	 //

	 //name
	 $name = $dom->createElement("name");
     $update->appendChild($name);

     $namev = $dom->createTextNode($row4['name']);
     $name->appendChild($namev); 
	 //
	 
	 //screenname
	 $screenname = $dom->createElement("screenname");
     $update->appendChild($screenname);

     $screennamev = $dom->createTextNode("null");
     $screenname->appendChild($screennamev); 
	 //
    
	//blogtype
	 $blogtype = $dom->createElement("blogtype");
     $update->appendChild($blogtype);

     $blogtypev = $dom->createTextNode("blog");
     $blogtype->appendChild($blogtypev); 
	
	 //content
	 $content = $dom->createElement("content");
     $update->appendChild($content);

     $contentv = $dom->createTextNode($row3['content']);
     $content->appendChild($contentv); 
	 // 
	 
	 //date
	 $datestring = strtotime($row3['update_time']);		
     $dateformatted = date('Y-m-d H:i:s', strtotime($row3['update_time']));
	 
	 $dater = $dom->createElement("dater");
     $update->appendChild($dater);

     $daterv = $dom->createTextNode($dateformatted);
     $dater->appendChild($daterv); 
	 //
		
		
	   
		   }
		
	 }
	}
		
    
	
	
	
	
	
	//access database
	
	$allfollowed2 = array();
	
	 $query12 = "SELECT user_id_followed FROM follow_connections WHERE user_id = '".$_SESSION['user']."'";
	
	 $result12 = $db->query($query12);
		
	 if($result12){
	
	 while ($row12 = $result12->fetch_assoc()) {
			$allfollowed2[] = $row12;
		    }
		 
	        }
      
    	$alltwitteraccountsfollowed = array();	
		
		foreach ($allfollowed2 as $each) {	
               
	    $query22 = "SELECT user_id, name, twitter FROM account_info WHERE user_id = '".$each['user_id_followed']."'";
	
	    $result22 = $db->query($query22);
		
		if($result22){
		while ($row22 = $result22->fetch_assoc()) {
			$alltwitteraccountsfollowed[] = $row22;
		    } 
	        }
		}

  // Require codebird
	require_once('codebird-php/src/codebird.php');
	// Require authentication parameters
	require_once('twitter_config.php');

	
	// Set connection parameters and instantiate Codebird	
	\Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
	$cb = \Codebird\Codebird::getInstance();
	$cb->setToken($access_token, $access_token_secret);
	
	$reply = $cb->oauth2_token();
	$bearer_token = $reply->access_token;
	
	// App authentication
	\Codebird\Codebird::setBearerToken($bearer_token);
	
	
foreach($alltwitteraccountsfollowed as $itom){
		
	// Create query
	$params = array(
		'screen_name' => $itom['twitter'],	
		'count' => 5,
	
	);
	
	// Make the REST call
	$res = (array) $cb->statuses_userTimeline($params);
	// Convert results to an associative array
	$data = json_decode(json_encode($res), true);
		
	// Optionally, store results in a file
	//file_put_contents("single_mu.json", json_encode($res));

	foreach ($data as $item){
	
	if(!empty($item['text'])){
	
	
	$update = $dom->createElement("update");
    $allupdates->appendChild($update);
		
	//id
	 $id = $dom->createElement("user_id");
     $update->appendChild($id);

     $idv = $dom->createTextNode($itom['user_id']);
     $id->appendChild($idv); 
	 //

	 //name
	 $name = $dom->createElement("name");
     $update->appendChild($name);

     $namev = $dom->createTextNode($itom['name']);
     $name->appendChild($namev); 
	 //
	 
	 //screenname
	 $screenname = $dom->createElement("screenname");
     $update->appendChild($screenname);

     $screennamev = $dom->createTextNode($itom['twitter']);
     $screenname->appendChild($screennamev); 
	 //
    
	//blogtype
	 $blogtype = $dom->createElement("blogtype");
     $update->appendChild($blogtype);

     $blogtypev = $dom->createTextNode("twitter");
     $blogtype->appendChild($blogtypev); 
	
	 //content
	 $content = $dom->createElement("content");
     $update->appendChild($content);

     $contentv = $dom->createTextNode($item['text']);
     $content->appendChild($contentv); 
	 // 
	 
	 //date
	 $datestring = strtotime($item['created_at']);		
     $dateformatted = date('Y-m-d H:i:s', strtotime($item['created_at']));
	 
	 $dater = $dom->createElement("dater");
     $update->appendChild($dater);

     $daterv = $dom->createTextNode($dateformatted);
     $dater->appendChild($daterv); 
	 //
	
	}
	
	
	}
	
	}
	


// save and display tree
 $dom->save("allupdates.xml");
 
 echo "update complete";

 
 ?>