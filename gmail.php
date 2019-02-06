<?php
include_once("app.php");
require __DIR__ . '/vendor/autoload.php';

function getHeader($headers, $name) {
  foreach($headers as $header) {
    if($header['name'] == $name) {
      return $header['value'];
    }
  }
}
    $client = new Google_Client();
    $client->setApplicationName('Gmail API PHP Quickstart');
    $client->setScopes(Google_Service_Gmail::GMAIL_READONLY);
    $client->setClientId($GOOGLE_CLIENT_ID);
    $client->setClientSecret($GOOGLE_SECRET);
    $client->setRedirectUri($GOOGLE_CALLBACK_URL);
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');
    if (isset($_SESSION['accessToken'])) {
        $client->setAccessToken($_SESSION['accessToken']);
    }

    if (isset($_GET['code'])) {
            $accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['accessToken'] = $client->getAccessToken();

  header('Location: ' . filter_var($GOOGLE_CALLBACK_URL, FILTER_SANITIZE_URL));
  exit;
     }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            $authUrl = $client->createAuthUrl();
        }
    }

if (isset($authUrl)){ 
    //show login url
    echo '<div style="margin:20px">';
    echo '<div align="center">';
    echo '<h3>Login with Google</h3>';
    echo '<div>Please click login button to connect to Google.</div>';
    echo '<a class="login" href="' . $authUrl . '"><img src="images/google-login-button.png" /></a>';
    echo '</div>';
    echo '</div>';
 exit;   
}


		$service = new Google_Service_Gmail($client);
		$message_data = [];
		$results = $service->users_messages->listUsersMessages('me', ['maxResults' => 10]);
		foreach($results as $mail){
		  $message = $service->users_messages->get('me', $mail['id']);
		  $headers = $message->getPayload()->getHeaders();
		$message_row['from'] = getHeader($headers, 'From');
		$message_row['subject'] = getHeader($headers, 'Subject');
		$message_row['date'] = getHeader($headers, 'Date');
		  $message_row['labels'] = implode(',', $message->getLabelIds()); 
		  $message_data[] = $message_row;
		}

             //generate csv file
          $list=array();
        $list['tableheading'] =array('From','Subject','Date','Labels');
        $fichier = 'EmailInbox.xls';
        header( "Content-Type: text/csv;charset=utf-8" );
        header( "Content-Disposition: attachment;filename=\"$fichier\"" );
        header("Pragma: no-cache");
        header("Expires: 0");
        $fp= fopen('php://output', 'w');
        fputcsv($fp,$list['tableheading'] );
        foreach($message_data AS $tabledata) {              
            $data['list']=array($tabledata['from'],$tabledata['subject'],$tabledata['date'],$tabledata['labels']);
            fputcsv($fp, $data['list']);
        }
        fclose($fp);
        exit();




 ?>