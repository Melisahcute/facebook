<?php
include "Facebook/autoload.php"; // panggil autoload dari Facebook SDK

$app_id = "374895866674241";
$secret_id = "46a586c7f90d0bd93c7030b15b41f9e8";

$fb = new FacebookFacebook([
    'app_id' => $app_id,
    'app_secret' => $secret_id,
    'default_graph_version' => 'v2.9',
    //'default_access_token' => '{access-token}', // optional
]);

try {
    // Get the FacebookGraphNodesGraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me?fields=first_name,last_name,email,id,gender', $_POST['oauth_token']);
} catch(FacebookExceptionsFacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(FacebookExceptionsFacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$me = $response->getGraphUser();
$fullName = $me['first_name']." ".$me['last_name'];
$email = $me['email'];
$id    = $me['id'];
$ip    = $_SERVER['REMOTE_ADDR'];

echo "Nama : ".$fullName.", Email : ".$email;