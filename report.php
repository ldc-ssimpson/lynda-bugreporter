<?php
require_once("secrets.php");
// print "Ping: \n";
// api_request('/ping');
// print "\n\nCategories: \n";
// api_request('/categories?filter.includes=ID,Name');
// print "\n\nCourses: \n";
// api_request('/courses?filter.includes=ID,Title,URLs');
api_request('/course/380092');

function api_request($api_endpoint = '') {
	$timestamp = time();
	$url = LYNDA_API_URL.$api_endpoint;

  $curl_headers = array
	(
		'appkey: '.APP_KEY,
		'timestamp: '.$timestamp,
		'hash: '.md5(APP_KEY.SECRET_KEY.$url.$timestamp)
	);

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_URL, $url);

	curl_setopt($curl, CURLOPT_HTTPHEADER, $curl_headers);

  $result = curl_exec($curl);
  curl_close($curl);

  $obj = json_decode($result);
print_r($obj);
  return $obj;
}
