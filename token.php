<?php
include('./vendor/autoload.php');

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

// Use identity and room from query string if provided
$identity = isset($_GET["identity"]) ? $_GET["identity"] : "identity";
$room = isset($_GET["room"]) ? $_GET["room"] :  "";

$TWILIO_ACCOUNT_SID = 'AC6dd0eeab9d76a842b9ef982563bae6d7';
$TWILIO_API_KEY = 'SK03e5bc8ade9fe113d174fadbf2fd8437';
$TWILIO_API_SECRET = 'P29ExbLAYMW1wY0mzwTCtw0ry4obbkg1';

// Create access token, which we will serialize and send to the client
$token = new AccessToken(
    $TWILIO_ACCOUNT_SID, 
    $TWILIO_API_KEY, 
    $TWILIO_API_SECRET, 
    3600, 
    $identity
);

// Grant access to Video
$grant = new VideoGrant();
$grant->setRoom($room);
$token->addGrant($grant);

echo $token->toJWT();
