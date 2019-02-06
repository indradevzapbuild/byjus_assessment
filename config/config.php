<?php
session_start();
$BASE_URL = 'http://localhost/byjus_test/';				// base or site url is the site where code 																		
//linkedin credentials files
$LINKEDIN_CALLBACK_URL = 'http://localhost/byjus_test/linkedincallback.php';	//callback or redirect url is the page you 																	want to open after successful getting of data															
$LINKEDIN_APP_ID = '78va8ju80wvce1';								//APP ID(will receive from linkedin dashboard)
$LINKEDIN_APP_SECRET = 'bpigzwiW0lkZCrki';						//APP Client 
$LINKEDIN_SCOPE = 'r_basicprofile r_emailaddress';	

//Google credentials file
$GOOGLE_CLIENT_ID = '439869073389-kvd2qbin40f4q8qstvt3rj41l1odfmb4.apps.googleusercontent.com'; 
$GOOGLE_SECRET = 'MLuDLnB4JirfmYTZwQYagnG8';
$GOOGLE_CALLBACK_URL = 'http://localhost/byjus_test/gmail.php';	

?>