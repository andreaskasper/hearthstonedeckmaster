<?php
unset($_SESSION["myuser"]);
header($_SERVER["SERVER_PROTOCOL"]." 307 abgemeldet"); 
header('Location: /index.html?t='.time());
exit(1);