<?php
PageEngine::html("html_head");
PageEngine::html("header");
PageEngine::html("breadcrumbs");
?>
<div id="page-content">
                    


<?php
echo(nl2br(str_replace(' ','&nbsp;',var_export($_SESSION,true))));
?>



</div><!-- #page-content -->
<?php
PageEngine::html("html_footer");
?>

