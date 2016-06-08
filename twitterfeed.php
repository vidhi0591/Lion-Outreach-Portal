<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>


<?php 

if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

echo "Here's the Twitter newsfeed of the people you have followed! <button type='button' onclick='generateXML()'>Refresh Newsfeed</button>

<br /><br /> <div id='loadSpace'>Updating Twitter Newsfeed...</div>




";

}
?>

<script>
function generateXML()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
 xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    displayXML();
    }
  }
    
 xmlhttp.open("GET","DOM.php",true);
 xmlhttp.send();

}



function displayXML(){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	 
	var xmlDoc = xmlhttp.responseXML;

	//document.getElementById("myDiv1").innerHTML=xmlDoc;
    var eachtweet = xmlDoc.getElementsByTagName("tweet");
	
	var alltweets = []; 
	
	for (i=0;i< eachtweet.length ;i++){
	
	 
	alltweets.push({tweetcontent: xmlDoc.getElementsByTagName("tweetcontent")[i].childNodes[0].nodeValue, 
	                tweeter:  xmlDoc.getElementsByTagName("tweeter")[i].childNodes[0].nodeValue,
					screenname: xmlDoc.getElementsByTagName("screenname")[i].childNodes[0].nodeValue,
	                tweetdate: xmlDoc.getElementsByTagName("tweetdate")[i].childNodes[0].nodeValue});
					
	}
	
	alltweets.sort(function (a,b) {
    var c = new Date(a.tweetdate);
    var d = new Date(b.tweetdate);
    return c-d;
     });
	 
	 alltweets.reverse();
	 
	
	
	
	var test = "---------------------------------------------------------   <br/> ";
	
	for (i=0;i< eachtweet.length;i++)
  { 
    test = test + "<b>" + alltweets[i].tweeter + "</b>   (" + alltweets[i].screenname + ") tweeted: ";
	
	test = test + "<br/> <br/> " + alltweets[i].tweetcontent;
	
	test = test + "<br/> <br/> <br/> <i> <img src='https://g.twimg.com/Twitter_logo_blue.png' width='22' height='18'> Updated Time: " + alltweets[i].tweetdate;
  
    test = test + "</i> <br/> ---------------------------------------------------------   <br/> ";
  
    }
	
    document.getElementById("loadSpace").innerHTML= test;
  
  }
  }
  
xmlhttp.open("GET","alltweets.xml",true);
xmlhttp.send();
  
  }

  
function setAutomatic()
{
setInterval(generateXML(),900000);
}


window.onload = generateXML;
//window.onload = displayXML;


window.onload = setAutomatic;



</script>






<?php include 'rightcolumn.php'; ?>		
<?php include 'footer.php'; ?>
	