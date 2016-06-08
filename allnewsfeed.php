<?php include_once 'session.php'; ?>
<?php include 'opendb.php'; ?>
<?php include 'header.php'; ?>


<?php 

if($login == false){

echo "You are not logged in. Click <a href='register.php'> here </a> to register for an account";

}else{

echo "Here's all the updates of people you have followed! <button type='button' onclick='generateXML()'>Refresh Newsfeed</button>
 <br /><br /> <div id='loadSpace'>Updating Newsfeed...</div> ";

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
    
 xmlhttp.open("GET","allDOM.php",true);
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
    var eachupdate = xmlDoc.getElementsByTagName("update");

	
	var allupdates = []; 
	
	for (i=0;i< eachupdate.length ;i++){
	
	 
	allupdates.push({
	                user_id: xmlDoc.getElementsByTagName("user_id")[i].childNodes[0].nodeValue, 
	                name:  xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue,
					screenname: xmlDoc.getElementsByTagName("screenname")[i].childNodes[0].nodeValue, 
	                blogtype:  xmlDoc.getElementsByTagName("blogtype")[i].childNodes[0].nodeValue,
					content: xmlDoc.getElementsByTagName("content")[i].childNodes[0].nodeValue,
	                date: xmlDoc.getElementsByTagName("dater")[i].childNodes[0].nodeValue});
					
	}	
	
	allupdates.sort(function (a,b) {
    var c = new Date(a.date);
    var d = new Date(b.date);
    return c-d;
     });
	

	 allupdates.reverse();
	
	//document.getElementById("loadSpace").innerHTML = "try gay" ;

	var test = "---------------------------------------------------------   <br/> ";
	
	for (i=0;i< eachupdate.length ;i++)
  { 
    test = test + "<b> <a href='profile.php?user_id=" + allupdates[i].user_id + "'>" + allupdates[i].name + " </a></b> ";
	
	if(allupdates[i].screenname === "null"){
	
	test = test + "	posted on mySFU blog: ";
	
	} else {
	
	test = test + "(" + allupdates[i].screenname + ") tweeted: ";
	
	}
	
	test = test + "<br/> <br/> " + allupdates[i].content;
	
	if(allupdates[i].blogtype === "blog"){
	
	test = test + "<br/> <br/> <br/> <i> <img src='https://www.sfu.ca/content/sfu/clf/branding/_jcr_content/main_content/textimage/image.img.jpg/1375138118331.jpg' width='22' height='14'> Updated Time: " + allupdates[i].date;
   
    } else {
    
	test = test + "<br/> <br/> <br/> <i> <img src='https://g.twimg.com/Twitter_logo_blue.png' width='22' height='18'> Updated Time: " + allupdates[i].date;
   
  
    }
    
	test = test + "</i> <br/> ---------------------------------------------------------   <br/> ";
  
    
	
    
    document.getElementById("loadSpace").innerHTML= test;
  
   }
  
  
  }
  }
  
   xmlhttp.open("GET","allupdates.xml",true);
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
	