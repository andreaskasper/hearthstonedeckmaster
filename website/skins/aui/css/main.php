<?php
error_reporting(10);
require_once("../../../app/code/classes/class.CssMin.php");
//require_once("../../../classes/class.mcache.php");
require_once("../../../app/code/classes/class.lessc.php");
date_default_timezone_set("Europe/Berlin");
$cacheID = md5(__FILE__);

//prüfe auf gzip
//$canGZIP = (!isset($_GET["nozip"]) AND (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')));
//if ($canGZIP) $cacheID .= "_gzip";

header("Content-Type: text/css; charset=utf-8");
$expires = 3600;
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
//if ($canGZIP) header("Content-Encoding: gzip");
//if (!isset($_GET["nocache"]) OR !$_GET["nocache"]) $a = mcache::get($cacheID);
//if (isset($a) AND $a != "") die($a."/*byCache*/");

$d= array();
$handle = opendir("main.css");
while (false !== ($file = readdir($handle))) {
	if (substr($file,0,1) != ".") $d[] = "main.css/".$file;
}
sort($d);

$css = "";
foreach ($d as $a) { $css.=file_get_contents($a)."\r\n\r\n"; }



/*$less = new lessc;
try {
  $css = $less->compile($css);
} catch (exception $e) {
  echo "/*\n*\n* Fatal Error (LESS): " . $e->getMessage()."*\n*"."/";
}*/

$css = preg_replace_callback("`(border-radius|border-bottom-radius)\s*:\s*([0-9]+)\s*(px)\s*\;`", "scan_borderradius", $css);

function scan_borderradius($m) {
	switch ($m[1]){
		case "border-radius":
			return '-webkit-border-radius: '.$m[2].$m[3].';-moz-border-radius: '.$m[2].$m[3].';border-radius: '.$m[2].$m[3].';';
		case "border-bottom-radius":
			return '-webkit-border-bottom-right-radius: '.$m[2].$m[3].';
-webkit-border-bottom-left-radius: '.$m[2].$m[3].';
-moz-border-radius-bottomright: '.$m[2].$m[3].';
-moz-border-radius-bottomleft: '.$m[2].$m[3].';
border-bottom-right-radius: '.$m[2].$m[3].';
border-bottom-left-radius: '.$m[2].$m[3].';';
		default: 
			die($m[0]);
			return $m[0];
	}
}


if (!isset($_GET["optimize"]) OR $_GET["optimize"]+0 == 1) $css = CssMin::minify($css, array
        (
        "remove-empty-blocks"           => true,
        "remove-empty-rulesets"         => true,
        "remove-last-semicolons"        => true,
        "convert-css3-properties"       => true,
        "convert-font-weight-values"    => true, // new in v2.0.2
        "convert-named-color-values"    => true, // new in v2.0.2
        "convert-hsl-color-values"      => true, // new in v2.0.2
        "convert-rgb-color-values"      => true, // new in v2.0.2; was "convert-color-values" in v2.0.1
        "compress-color-values"         => true,
        "compress-unit-values"          => true,
        "emulate-css3-variables"        => true
        )).chr(13)."/*erstellt ".date("d.m.Y H:i:s")."*"."/";

/*if ($canGZIP) $css = gzencode($css, 9, FORCE_GZIP);
mcache::set($cacheID, $css, 86400);*/
die ($css);