<?php
define("asi_allowed_entrypoint", true);

$_ENV["basepath"] = dirname(__FILE__);
include(dirname(__FILE__)."/app/code/includes/autoload.php");

@include(dirname(__FILE__)."/app/config.standard.php");
/*if (!file_exists("app/config.standard.php") OR !defined("asi_configuration_loaded")) { //Installation wird gestartet
	include(dirname(__FILE__)."/app/code/includes/routing.install.php");
	exit(1);
}*/

include(dirname(__FILE__)."/app/code/includes/standard.php");
@include(dirname(__FILE__)."/locales/".$_SESSION["language"]."/locale.php");
include(dirname(__FILE__)."/app/code/includes/routing.php");