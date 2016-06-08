<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php
//access database

$allfollowed = array();
	
	 $query1 = "SELECT user_id_followed FROM follow_connections WHERE user_id = '".$_SESSION['user']."'";
	
	 $result1 = $db->query($query1);
		
	if($result1){
	
	 while ($row1 = $result1->fetch_assoc()) {
			$allfollowed[] = $row1;
		    }
		 
	        }
      
    	$alltwitteraccountsfollowed = array();	
		
		foreach ($allfollowed as $each) {	
               
	    $query2 = "SELECT user_id, name, twitter FROM account_info WHERE user_id = '".$each['user_id_followed']."'";
	
	    $result2 = $db->query($query2);
		
		if($result2){
		while ($row2 = $result2->fetch_assoc()) {
			$alltwitteraccountsfollowed[] = $row2;
		    } 
	        }
		}
		

// create doctype

$dom = new DOMDocument("1.0");

// display document in browser as plain text 
// for readability purposes
header("Content-Type: text/plain");

// create root element
$alltweets = $dom->createElement("alltweets");
$dom->appendChild($alltweets);


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
	
	
foreach($alltwitteraccountsfollowed as $screenname){
		
	// Create query
	$params = array(
		'screen_name' => $screenname['twitter'],	
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
	
	$tweet = $dom->createElement("tweet");
    $alltweets->appendChild($tweet);

	//content
// create child element
    $tweetcontent = $dom->createElement("tweetcontent");
    $tweet->appendChild($tweetcontent);

// create text node
     $content = $dom->createTextNode($item['text']);
     $tweetcontent->appendChild($content);

	
	 //tweeter
	$tweeter = $dom->createElement("tweeter");
    $tweet->appendChild($tweeter);

     // create text node
     $tweeter_user_id = $dom->createTextNode($screenname['name']);
     $tweeter->appendChild($tweeter_user_id); 
	 
	 //tweeter
	$account = $dom->createElement("screenname");
    $tweet->appendChild($account);

     // create text node
     $account_name = $dom->createTextNode($screenname['twitter']);
     $account->appendChild($account_name); 
	 
	 
	 //date
	 $datestring = strtotime($item['created_at']);
			
     $dateformatted = date('Y-m-d H:i:s', strtotime($item['created_at']));
	
// create child element
    $tweetdate = $dom->createElement("tweetdate");
    $tweet->appendChild($tweetdate);

// create text node
    $date = $dom->createTextNode($dateformatted);
    $tweetdate->appendChild($date);
	
	}
	
	
	}
	
	}
	


// save and display tree
 $dom->save("alltweets.xml");
 
 echo "update complete";

 
 ?>