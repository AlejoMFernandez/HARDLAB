<?php
  require_once 'vendor/autoload.php';

  $clientID = '10853844935-l4d93lqqlcef8t2kutae856len5k0evd.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/HARDLAB/main.html';

  // create Client Request to access Google API
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");
?>