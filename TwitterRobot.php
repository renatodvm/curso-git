<?php
require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
'oauth_access_token' => "2853577365-zsi6m0YBWhCJC41UKJiERQrVJMGyZ9thTB1SnDW",
'oauth_access_token_secret' => "BBhyMEdbl2kHSW9xir5YU1BowNNlkPPTtdBeEwTeic55h",
'consumer_key' => "p9XBTJPCWbXOg4ngSbYpXYR04",
'consumer_secret' => "g63iseJmsZ0C0LO5MdvYhoXjnhGaF8Tjfi5rHXwao9bzfzsi9Y"
);
$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
//$url = "https://api.twitter.com/1.1/search/tweets.json?q=pizza%20lang%3Apt&src=typd";
$requestMethod = "GET";
$getfield = '?screen_name=99pizzas&count=20';
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);
/*if($string["errors"][0]["message"] != "") {
	echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string[errors][0]["message"]."</em></p>";
	exit();
}*/

/*echo "<pre>";
print_r($string);
echo "</pre>";*/

foreach($string as $items) {
	echo "Time and Date of Tweet: ".$items['created_at']."<br />";
	echo "Tweet: ". $items['text']."<br />";
	echo "Tweeted by: ". $items['user']['name']."<br />";
	echo "Screen name: ". $items['user']['screen_name']."<br />";
	echo "Followers: ". $items['user']['followers_count']."<br />";
	echo "Friends: ". $items['user']['friends_count']."<br />";
	echo "Listed: ". $items['user']['listed_count']."<br /><hr />";
}
?>