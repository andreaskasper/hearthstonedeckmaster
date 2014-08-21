<?php
$db = new SQL(0);

if (isset($_GET["act"]) AND $_GET["act"] == "logingoogle") {

require_once($_ENV["basepath"].'/app/code/classes/Google/Client.php');

$client = new Google_Client();
$client->setClientId($_ENV["credentials"]["google"]["oauth2"]["client_id"]);
$client->setClientSecret($_ENV["credentials"]["google"]["oauth2"]["client_secret"]);
$client->setRedirectUri($_ENV["credentials"]["google"]["oauth2"]["redirect_uri"]);
$client->setScopes('email');


if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION["myuser"]["google"]['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();
  
  $row = $db->cmdrow(0, 'SELECT * FROM user_login WHERE provider = "google" AND account="{0}" LIMIT 0,1', array($token_data["payload"]["id"]));
  if (!isset($row["user_id"])) {
	$w = array();
	$w["email"] = $token_data["payload"]["email"];
	$w["dt_created"] = time();
	$db->Create(0, "user_list", $w);
	$id = $db->LastInsertKey();
	$w = array();
	$w["user_id"] = $id;
	$w["provider"] = "google";
	$w["account"] = $token_data["payload"]["id"];
	$db->Create(0, "user_login", $w);
	$row = $db->cmdrow(0, 'SELECT * FROM user_login WHERE provider = "google" AND account="{0}" LIMIT 0,1', array($token_data["payload"]["id"]));
  }
  MyUser::loginload($row["user_id"]);
  Notifications::add(0, "Herzlich Willkommen im Deckbuilder!", "/help_welcome.html","welcome",-1,"hand-o-right");
  Notifications::add(2, "Lege Dein erstes Deck an...", "/deckbuilder.html","first_deck",-1);
  Notifications::add(2, "Vervollständige Dein Profil!", "/profile.html","first_profile",-1);
  
  header($_SERVER["SERVER_PROTOCOL"]." 307 angemeldet"); 
  header('Location: /index.html?t='.time());
  exit(1);
}


header("Location: ".$client->createAuthUrl());
die("weiter zu login");
}

if (isset($_GET["act"]) AND $_GET["act"] == "loginfacebook") {
 die("Muss noch programmiert werden, aber Google geht schon!");
}

if (isset($_GET["act"]) AND $_GET["act"] == "logintwitter") {
 die("Muss noch programmiert werden, aber Google geht schon!");
}

if (isset($_POST["act"]) AND $_POST["act"] == "login") {
	$row = $db->cmdrow(0, 'SELECT * FROM user_login WHERE provider = "local" AND account="{0}" LIMIT 0,1', array($token_data["payload"]["id"]));
 die("Muss noch programmiert werden, aber Google geht schon!");
}