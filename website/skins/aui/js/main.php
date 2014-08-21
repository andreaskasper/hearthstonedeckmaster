<?php
/*
 * Programm zur komprimierten Ausgabe von Javascript Code
 * Parameter
 *   * nozip
 *   * nocache
 *   * nooptimize
 *
 */
//require_once("../../../classes/class.JShrink.php");
//require_once("../../../classes/class.mcache.php");
date_default_timezone_set("Europe/Berlin");
$cacheID = md5(__FILE__);

$canGZIP = (!isset($_GET["nozip"]) AND (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')));
if ($canGZIP) $cacheID .= "_gzip";

header("Content-Type: text/javascript; charset=utf-8");
$expires = 3600;
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
//if ($canGZIP) header("Content-Encoding: gzip");
//if (!isset($_GET["nocache"]) OR !$_GET["nocache"]) $a = mcache::get(__FILE__);
if (isset($a) AND $a != "") die($a."//byCache");


$d= array();
$handle = opendir("main.js");
while (false !== ($file = readdir($handle))) {
	if (substr($file,0,1) != ".") $d[] = "main.js/".$file;
}
sort($d);

$code="";
foreach ($d as $a) { $code.=file_get_contents($a)."\r\n\r\n"; }
//if (!isset($_GET["nooptimize"]) OR !$_GET["nooptimize"]) $code = JShrink::minify($code);
$code .= chr(13)."//erstellt aus ".count($d)." am ".date("d.m.Y H:i:s");


//if ($canGZIP) $code = gzencode($code, 9, FORCE_GZIP);
//mcache::set(__FILE__, $code, 86400);
die ($code);

