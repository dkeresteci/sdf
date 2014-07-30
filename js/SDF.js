function sendSMS(message, number){	
	var xmlhttp=new XMLHttpRequest();

	  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("response").innerHTML=xmlhttp.responseText;
    }
  }
	xmlhttp.open("POST","sendSMS.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("msg=" + message + "&num=" + number);
};

function getLocation(number){	
	var xmlhttp=new XMLHttpRequest();

	  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {

    	var response = JSON.parse(xmlhttp.responseText);
    	var lat  = response.result.latitude;
    	var lon = response.result.longitude;
    	var jsonString = JSON.stringify(response);
    	init_gmaps(lat, lon, 18, 5, "#49166D");
      document.getElementById("response").innerHTML= jsonString;
    }
  }
	xmlhttp.open("POST","getLocation.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("num=" + number);
};