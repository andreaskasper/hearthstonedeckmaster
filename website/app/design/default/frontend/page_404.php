<?php
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
PageEngine::html("html_head");
PageEngine::html("header");
PageEngine::html("breadcrumbs");
?>
<div id="page-content">
    <h3>404</h3>
	<p>Was? Da hat der unfähige Programmierer wohl einen Fehler gemacht!</p>
	<p>Naja, morgen schicken wir ihn dann wieder auf's Arbeitsamt und suchen uns einen Fähigeren.</p>
	<p>...oder vielleicht ist auch nur die URL falsch - schau doch einfach nochmal genau hin.</p>






</div><!-- #page-content -->
<?php
PageEngine::html("html_footer");
?>

