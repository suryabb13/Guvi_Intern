<?php
// Connect to Redis


$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// Get key from GET data
$sessionId = $_POST['key'];


// Retrieve email from Redis using the key
$email = $redis->get($sessionId);

// Return the email to the client
echo $email;
?>