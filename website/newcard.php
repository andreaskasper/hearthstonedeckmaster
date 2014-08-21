<?php
file_put_contents("newcardrequest.log",var_export($_POST,true),FILE_APPEND);
die(true);