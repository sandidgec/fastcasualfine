<?php
require 'tmhOAuth.php'; // Get it from: https://github.com/themattharris/tmhOAuth

// Use the data from http://dev.twitter.com/apps to fill out this info
// notice the slight name difference in the last two items)

$connection = new tmhOAuth(array(
  'consumer_key' => 'NtQ3vXB7f4dU5a0co3MTUVk1f',
	'consumer_secret' => 'YJgpkXAJdt6EhIxxY5I6okDZNOxab4UtPKzACs8GAC3E0LJMQf',
	'user_token' => '738452233050718208-rYKiloXesguS2IbXCJdHwROG1kfM8Hj', //access token
	'user_secret' => '1zahaXV8nRVxUXLEbYCjCZD5BfRjxJQjt898W9pEKBNgD' //access token secret
));

// set up parameters to pass
$parameters = array();

if ($_GET['count']) {
	$parameters['count'] = strip_tags($_GET['count']);
}

$twitter_path = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';
$http_code = $connection->request('GET', $connection->url($twitter_path), $parameters );

if ($http_code === 200) { // if everything's good
	$response = strip_tags($connection->response['response']);

  header("Content-type: application/json");

	if ($_GET['callback']) { // if we ask for a jsonp callback function
		echo $_GET['callback'],'(', $response,');';
	} else {
		echo $response;
	}
} else {
	echo "Error ID: ",$http_code, "<br>\n";
	echo "Error: ",$connection->response["error"], "<br>\n";
}

// You may have to download and copy http://curl.haxx.se/ca/cacert.pem
