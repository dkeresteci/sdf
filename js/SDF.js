function sendSMS(message, number){	
  $("#responseSMS").html("Sending...");
	var xmlhttp=new XMLHttpRequest();

	  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {

      try{
        var response = JSON.parse(xmlhttp.responseText);
        $("#responseSMS").html("Message Sent Successfully!<br>");
        
      }catch(err){
        $("#responseSMS").html("Send Message Unsuccessful<br>");
      }

    }
  }
	xmlhttp.open("POST","sendSMS.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("msg=" + message + "&num=" + number);
};

function getLocation(number){	
  //Displays location, address for work location, or says WFH, or handels a response error. 
  
  $("#map-canvas").hide();
  $("#response").empty();
  $("#floatingCirclesG").show();
	var xmlhttp=new XMLHttpRequest();

	  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      $("#floatingCirclesG").hide();
    	
        try{
          //See if the response is in json format and has a timestamp
          //If it doesn't - something went wrong
          var response = JSON.parse(xmlhttp.responseText);
          var timestamp = response.timestamp;         
        }catch(err){
          //$("#response").html("Could not retrieve location data <br>" + xmlhttp.responseText);
          $("#response").html("Could not retrieve location data <br>");
          return null; 
        }

        //If the reponse has an office name with it, display the location, if not say they are WFH
        if (response.name){
          $("#response").html("Working from: " + response.name + " at " + response.address);
          $("#map-canvas").show();
          init_gmaps(response.lat, response.lng, 14, 5, "#49166D");
        }else{
          $("#response").html("Working from Home");
        }
        
        //$("#response").html("lat: " + lat + " lng: " + lng + " timestamp: " + timestamp);
        //var jsonString = JSON.stringify(response);
       // init_gmaps(lat, lon, 18, 5, "#49166D");
       // document.getElementById("response").innerHTML= jsonString;
    	
    };
    if (xmlhttp.readyState==4 && xmlhttp.status!=200) {
      $("#response").html("Unsuccessful Request");
    };
  }
	xmlhttp.open("POST","getLocation.php",true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("num=" + number);
};

