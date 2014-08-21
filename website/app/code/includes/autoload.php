<?php

$_ENV["basepath"] = dirname(dirname(dirname(dirname(__FILE__))));
$_ENV["oma"]["version"] = "0.0.1 alpha";

/*
 * Mit dieser Funktion werden Klassen anhand ihres Namens automatisch geladen. Das Ergebnis spiegelt den Erfolg der Ausführung
 * @param string $class_name Name der Klasse, die geladen werden muss
 * @return boolean
 */
spl_autoload_register(function($class_name) {
	$prio = array();
	if (substr($class_name,0,4) == "API_") {
		require_once($_ENV["basepath"]."/app/api/0.1/classes/".substr($class_name,4,999).".php");
		return true;
	}
	
	/*if (substr($class_name,0,7) == "Smarty_") {
		$prio[] = $_ENV["basepath"]."/app/classes/Smarty/sysplugins/".strtolower($class_name).".php";
	}*/
	
	$prio[] = $_ENV["basepath"]."/app/code/helper/default/".$class_name.".php";
	$prio[] = $_ENV["basepath"]."/app/code/classes/class.".$class_name.".php";
	

	foreach ($prio as $file) {
		if (file_exists($file)) {
			require($file);
			return true;
		}
	}
	if (isset($_GET["debug"])) throw new Exception("Klasse ".$class_name." kann nicht gefunden werden!");
	return false;
});