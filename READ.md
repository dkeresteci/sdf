SDF Demostration Application
Daniel Keresteci
July 30, 2014

Requirements: Web server with PHP 5.2 or greater
-Full instructions for setting up a web server are not included here
-However, I set up a simple virtual machine running Ubuntu 14 (Or any debian based server)
-apt-get install apache2
-apt-get install php5-common libapache2-mod-php5 php5-cli


Open the sendSMS.php file and check the following three variables.

First - Edit the $cert variable to be the location of your certificate, or, load your certificate in the same directory as me

Second - Notice that the $message variable is set by the URL, and has a default message. Feel free to edit the way this variable is set

Third - Edit the $phoneNum variable to be any 10 or 11 digit number (Note, if your in production test that this number must be on it


Load the sendSMS.php file into your web directory.

Test it out! Go to http://your-domain-name.com/sendSMS.php?msg=<YOUR MESSAGE>


----
To call this PHP file from an JavaScript HTML page, load the sendSMS.js file in the same directory as the PHP file

//Include the sendSMS.js in your web page - or load the code into your existing JavaScript
<script src="sendSMS.js"></script>

Call the sendSMS function
sendSMS(message);