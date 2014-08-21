<div class="top-icon-bar dropdown">
                                <a href="javascript:;" title="" class="user-ico clearfix" data-toggle="dropdown">
                                    <img width="36" src="//www.gravatar.com/avatar/<?=md5(strtolower(trim($_SESSION["myuser"]["email"]))); ?>?d=monsterid" alt="">
                                    <span><?=html(MyUser::username()); ?></span>
                                    <i class="glyph-icon icon-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu float-right">
                                    <li>
                                        <span class="badge badge-absolute float-left radius-all-100 mrg5R bg-green tooltip-button" title="" data-original-title="You can add badges even to dropdown menus!">7</span>
                                        <a href="javascript:;" title="">
                                            <i class="glyph-icon icon-user mrg5R"></i>
                                            Mein Profil
                                        </a>
                                    </li>
                                    
                                    <li class="divider"></li>
									<li>
                                        <a href="/logout.html" title="abmelden">
                                            <i class="glyph-icon icon-signout font-size-13 mrg5R"></i>
                                            <span class="font-bold">abmelden</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="top-icon-bar">
							
<?php
if (!isset($_SESSION["myuser"]["last_mails_load"]) OR ($_SESSION["myuser"]["last_mails_load"]+600 < time())) {
	$db = new SQL(0);
	$_SESSION["myuser"]["mails"] = $db->cmdrows(0, 'SELECT T1.*, (SELECT email FROM user_list WHERE id=T1.user_from LIMIT 0,1) as email_from FROM user_mailings as T1 WHERE user_to = "{0}" ORDER BY (dt_read is NULL) DESC, dt_created DESC', array(MyUser::id()));
}

?>							
							
							
                                <a href="javascript:;" class="popover-button" data-placement="bottom" title="Nachrichten" data-id="#msg-box">
<?php
	if (count($_SESSION["myuser"]["mails"]) > 0) echo('<span class="badge badge-absolute bg-orange">'.count($_SESSION["myuser"]["mails"]).'</span>');
?>
                                    <i class="glyph-icon icon-envelope-o"></i>
                                </a>
                                <div id="msg-box" class="hide">

                                    <div class="scrollable-content scrollable-small">

                                        <ul class="no-border messages-box">
<?php
foreach ($_SESSION["myuser"]["mails"] as $row) {
	$difftime = time()-$row["dt_created"];
	if ($difftime < 100) $timetxt = "vor ".$difftime." Sekunden";
	elseif ($difftime <   6000) $timetxt = "vor ".floor($difftime/60)." Minuten";
	elseif ($difftime < 100000) $timetxt = "vor ".floor($difftime/3600)." Stunden";
	elseif ($difftime < 3000000) $timetxt = "vor ".floor($difftime/86400)." Tagen";
	else $timetxt = "am ".date("d.m.Y", $row["dt_created"]);
	echo('<li>
                                                <div class="messages-img">
                                                    <img width="32" src="//www.gravatar.com/avatar/'.md5(strtolower(trim($row["email_from"]))).'?d=monsterid" alt="Absender">
                                                </div>
                                                <div class="messages-content">
                                                    <div class="messages-title">
                                                        <i class="glyph-icon icon-tag font-blue"></i>
                                                        <a href="/inbox.html?id='.$row["id"].'" title="'.html($row["subject"]).'">'.html($row["subject"]).'</a>
                                                        <div class="messages-time">
                                                            '.html($timetxt).'
                                                            <span class="glyph-icon icon-time"></span>
                                                        </div>
                                                    </div>
                                                    <div class="messages-text">
                                                        '.html(string2::Abkuerzung($row["msg"], 160)).'
                                                    </div>
                                                </div> 
                                            </li>');













}


?>
                                            
                                        </ul>

                                    </div>
                                    <div class="pad10A button-pane button-pane-alt">
                                        <a href="messaging.html" class="btn small float-left bg-gray">
                                            <a href="inbox.html" class="button-content text-transform-upr font-size-11">Postfach</a>
                                        </a>
                                        <div class="button-group float-right">
                                            <a href="javascript:;" class="btn small primary-bg">
                                                <i class="glyph-icon icon-star"></i>
                                            </a>
                                            <a href="javascript:;" class="btn small primary-bg">
                                                <i class="glyph-icon icon-random"></i>
                                            </a>
                                            <a href="javascript:;" class="btn small primary-bg">
                                                <i class="glyph-icon icon-map-marker"></i>
                                            </a>
                                        </div>
                                        <a href="javascript:;" class="small btn bg-red float-right mrg10R tooltip-button" data-placement="left" title="Remove comment">
                                            <i class="glyph-icon icon-remove"></i>
                                        </a>
                                    </div>

                                </div>
								
								
<?php
if (!isset($_SESSION["myuser"]["last_notification_load"]) OR ($_SESSION["myuser"]["last_notification_load"]+300 < time())) {
	$db = new SQL(0);
	$_SESSION["myuser"]["notifications"] = $db->cmdrows(0, 'SELECT * FROM user_notifications WHERE user_id = "{0}" ORDER BY dt_created DESC', array(MyUser::id()));
}

?>

                                <a href="javascript:;" class="popover-button" data-placement="bottom" title="" data-id="#notif-box">
<?php
if (count($_SESSION["myuser"]["notifications"]) > 0) echo('<span class="badge badge-absolute bg-green">'.count($_SESSION["myuser"]["notifications"]).'</span>');
?>								
                                    
                                    <i class="glyph-icon icon-bell-o"></i>
                                </a>
                                <div id="notif-box" class="hide">

									<form action="/notifications.html">
                                    <div class="popover-title display-block clearfix form-row pad10A">
                                        <div class="form-input">
                                            <div class="form-input-icon">
                                                <i class="glyph-icon icon-search transparent"></i>
                                                <input type="text" placeholder="Suche in Benachrichtigungen" class="radius-all-100" name="q" id="">
                                            </div>
                                        </div>
                                    </div>
									</form>
                                    <div class="scrollable-content scrollable-small">

                                        <ul class="no-border notifications-box">
<?php
$i = 0;
$icons = array("bg-blue","bg-green","bg-orange","bg-red");
foreach ($_SESSION["myuser"]["notifications"] as $row) {
	$difftime = time()-$row["dt_created"];
	if ($difftime < 100) $timetxt = "vor ".$difftime." Sekunden";
	elseif ($difftime <   6000) $timetxt = "vor ".floor($difftime/60)." Minuten";
	elseif ($difftime < 100000) $timetxt = "vor ".floor($difftime/3600)." Stunden";
	elseif ($difftime < 3000000) $timetxt = "vor ".floor($difftime/86400)." Tagen";
	else $timetxt = "am ".date("d.m.Y", $row["dt_created"]);

	echo('<li>
                                                <span class="btn '.$icons[$row["type"]].' icon-notification glyph-icon icon-'.(isset($row["icon"])?$row["icon"]:'user').'"></span>
                                                <a href="/notifications.html?goto='.urlencode($row["msgkey"]).'" class="notification-text">'.html($row["txt"]).'</a>
                                                <div class="notification-time">
                                                    '.$timetxt.'
                                                    <span class="glyph-icon icon-time"></span>
                                                </div>
                                            </li>');
}
?>

                                        </ul>

                                    </div>
                                    <div class="pad10A button-pane button-pane-alt text-center">
                                        <a href="/notifications.html" class="btn medium ui-state-default">
                                            <span class="button-content">zeige alle Benachrichtigungen</span>
                                        </a>
                                    </div>

                                </div>
                            </div>