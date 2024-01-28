<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
// Get key from GET data
$sessionId = $_POST['key'];
$email = $redis->get($sessionId);
// Return the email to the client
echo $email;
?>
