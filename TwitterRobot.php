<?php
require_once('TwitterAPIExchange.php');


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
'oauth_access_token' => "2853577365-zsi6m0YBWhCJC41UKJiERQrVJMGyZ9thTB1SnDW",
'oauth_access_token_secret' => "BBhyMEdbl2kHSW9xir5YU1BowNNlkPPTtdBeEwTeic55h",
'consumer_key' => "p9XBTJPCWbXOg4ngSbYpXYR04",
'consumer_secret' => "g63iseJmsZ0C0LO5MdvYhoXjnhGaF8Tjfi5rHXwao9bzfzsi9Y"
);

/********** INÍCIO - Teste para listar os 20 tweets do 99pizzas*/
/*$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";
$getfield = '?screen_name=99pizzas&count=20';
$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);*/

//if($string["errors"][0]["message"] != "") {
//	echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>" . $string[errors][0]["message"]."</em></p>";
//	exit();
//}

/*echo "<pre>";
print_r($string);
echo "</pre>";*/

//foreach($string as $items) {
	/*echo "Time and Date of Tweet: ".$items['created_at']."<br />";
	echo "Tweet: ". $items['text']."<br />";
	echo "Tweeted by: ". $items['user']['name']."<br />";
	echo "Screen name: ". $items['user']['screen_name']."<br />";
	echo "Followers: ". $items['user']['followers_count']."<br />";
	echo "Friends: ". $items['user']['friends_count']."<br />";
	echo "Listed: ". $items['user']['listed_count']."<br />";
	echo "Id: ". $items['id_str']."<br /><hr />";*/
//}
/********** FIM - Teste para listar os 20 tweets do 99pizzas*/




/****** INÍCIO DO BOT! PESQUISA QUE DEU CERTO PRA MONTAR O BOT: PIZZA COM LANGUAGE PT */
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=pizza lang:pt&count=10';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
 
$string = json_decode($twitter->setGetfield($getfield)
                     ->buildOauth($url, $requestMethod)
                     ->performRequest(), $assoc = TRUE);



$url="https://api.twitter.com/1.1/favorites/create.json";
$requestMethod = 'POST';
foreach($string as $statuses) {
	
	foreach($statuses as $status) {
		if (is_array($status) && array_key_exists('id_str', $status)) {
			echo "Curtindo Id: ". $status['id_str']."<br /><hr />";
			$postfields = array("id"=>$status['id_str']);

			$twitter = new TwitterAPIExchange($settings);
			$response =  $twitter->buildOauth($url, $requestMethod)
				->setPostfields($postfields)
				->performRequest();
		}
	}
	
}
/****** FIM DO BOT! PESQUISA QUE DEU CERTO PRA MONTAR O BOT: PIZZA COM LANGUAGE PT */





/********** INÍCIO - Teste de curtir (favorite)*/

/* PEGA OS TWEETS DE UMA PESQUISA, FAZ UM LOOP E CURTE TODOS!
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=#kosher+AND+#healthy';
$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
    ->buildOauth($url, $requestMethod)
    ->performRequest();

$result = json_decode($response);
foreach ($result->statuses as $ind=>$val)
{
    $url="https://api.twitter.com/1.1/favorites/create.json";
    $postfields = array("id"=>$val->id);
    $requestMethod = 'POST';

    $twitter = new TwitterAPIExchange($settings);
    $response =  $twitter->buildOauth($url, $requestMethod)
        ->setPostfields($postfields)
        ->performRequest();

    var_dump(json_decode($response));
}*/

// Pesquisa no twitter: pizza lang:pt

// Exemplo de curtida em um único tweet - DEU CERTO!
/*
$url="https://api.twitter.com/1.1/favorites/create.json";
$postfields = array("id"=>"520958929275482112");
$requestMethod = 'POST';

$twitter = new TwitterAPIExchange($settings);
$response =  $twitter->buildOauth($url, $requestMethod)
	->setPostfields($postfields)
	->performRequest();
*/
/**********FIM - Teste de curtir (favorite)*/
?>