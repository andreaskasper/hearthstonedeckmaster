    <body class="fixed-sidebar fixed-header">
        

        <div id="loading" class="ui-front loader ui-widget-overlay bg-white opacity-100">
            <img src="/skins/aui/img/layout/loader-dark.gif" alt="">
        </div>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <div id="page-wrapper" class="demo-example">

            <div id="page-sidebar">
                <div id="header-logo">
                    <h1 onclick="document.location.href='/index.html';">JN! Hearthstone</h1>

                    <a href="javascript:;" class="tooltip-button" data-placement="bottom" title="schliesse Seitenleiste" id="close-sidebar">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" data-placement="bottom" title="Öffne Seitenleiste" id="rm-close-sidebar">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
                    <a href="javascript:;" class="tooltip-button hidden" title="Navigation Menu" id="responsive-open-menu">
                        <i class="glyph-icon icon-align-justify"></i>
                    </a>
                </div>
                <div id="sidebar-search">
                    <input type="text" placeholder="Suchen" class="autocomplete-input tooltip-button" data-placement="right" title="Diese Funktion ist noch nicht aktiviert..." id="" name="">
                    <i class="glyph-icon icon-search"></i>
                </div>
                <div id="sidebar-menu" class="scrollable-content">
<?php
if (MyUser::isloggedin()) { ?>
                    <ul>
                        <li>
                            <a href="/index.html" title="Dashboard">
                                <i class="glyph-icon icon-dashboard"></i>
                                Dashboard
                            </a>
                        </li>
						<li>
                            <a href="/deckbuilder.html" title="Streams">
                                <i class="glyph-icon icon-list"></i>
                                Deckbuilder
                            </a>
                        </li>
						<li>
                            <a href="javascript:;" title="Dashboard">
                                <i class="glyph-icon icon-list"></i>
                                Meine Decks
                            </a>
							<ul>
								<li><a href="javascript:;" title="Grid Layouts"><i class="glyph-icon icon-chevron-right"></i>alle</a></li>
								<li><a href="javascript:;" title="Grid Layouts"><i class="glyph-icon icon-chevron-right"></i>aktive</a></li>
							</ul>
                        </li>
						
<?php } else { ?>
				<ul>
                        <li>
                            <a href="/login.html" title="amelden">
                                <i class="glyph-icon icon-user"></i>
                                anmelden/registrieren
                            </a>
                        </li>
						<li>
                            <a href="/deckbuilder.html" title="Streams">
                                <i class="glyph-icon icon-list"></i>
                                Deckbuilder
                            </a>
                        </li>
<?php } ?>

						<li>
                            <a href="/streams.html" title="Streams">
                                <i class="glyph-icon icon-video-camera"></i>
                                Streams
                            </a>
                        </li>
						<li>
                            <a href="/news.html" title="News">
                                <i class="glyph-icon icon-rss"></i>
                                News
                            </a>
                        </li>
						<li>
                            <a href="/extras.html" title="Extras">
                                <i class="glyph-icon icon-book"></i>
                                Extras
                            </a>
                        </li>
						<li>
                            <a href="/help.html" title="Hilfe">
                                <i class="glyph-icon icon-question"></i>
                                Hilfe
                            </a>
                        </li>
                    </ul>

                    <div class="divider mrg5T mobile-hidden"></div>
                    <div class="text-center mobile-hidden">
                        <div class="button-group">
                            <a href="mailto:jndeckbuildersupport@goo1.de" class="btn medium ui-state-default tooltip-button" data-placement="top" title="Ein Problem melden">
                                <i class="glyph-icon icon-flag"></i>
                            </a>
                            <!--<a href="javascript:;" class="btn medium ui-state-default tooltip-button" data-placement="bottom" title="Bottom tooltip">
                                <i class="glyph-icon icon-inbox"></i>
                            </a>
                            <a href="javascript:;" class="btn medium ui-state-default tooltip-button" data-placement="right" title="Right tooltip">
                                <i class="glyph-icon icon-hdd-o"></i>
                            </a>-->
                        </div>

                        <div class="divider"></div>
                    </div>
                </div>

            </div><!-- #page-sidebar -->
            
            <div id="page-main">

                <div id="page-main-wrapper">

                    <div id="page-header" class="clearfix">
                        <div id="page-header-wrapper" class="clearfix">
<?php
if (MyUser::isloggedin()) PageEngine::html("header_userloggedin");
else {
?>

<div class="button-group mrg10R float-right tooltip-button" data-placement="left" title="Klicke hier um Dich anzumelden">

                                <a class="btn" href="/login.html">
                                    <span class="button-content">
                                        <i class="glyph-icon icon-lightbulb-o float-left"></i>anmelden/registrieren
                                    </span>
                                </a>

</div>

<?php
} //User ist nich angemeldet! ?>
                            
			
							<div class="button-group dropdown float-right">
                                <a class="btn black-modal-60" href="javascript:;">
                                    <span class="button-content text-center float-none font-size-11 text-transform-upr">
                                        <i class="glyph-icon icon-check-sign float-right"></i>
                                        <img src="/skins/aui/img/icons/flags/de_DE.png" class="icon"/>
                                    </span>
                                </a>
                                <a class="btn" href="javascript:;" data-toggle="dropdown">
                                    <span class="glyph-icon icon-separator">
                                        <i class="glyph-icon icon-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu push-left">
                                    <li class=""><a href="/de/" data-toggle="dropdown" title=""><img class="icon" src="/skins/aui/img/icons/flags/de_DE.png"/> deutsch</a></li>
                                </ul>
                            </div>
							
							
							

                            <div id="theme-styling" class="hide">
                                <div class="small-box">
                                    <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A">Layout Color Schemes:</div>
                                    <div class="pad10A clearfix change-layout-theme">
                                        <p class="font-gray-dark font-size-11 pad0B">Click to change the layout color scheme. You can associate different color schemes for layouts and main content elements.</p>
                                        <div class="divider mrg10T mrg10B"></div>
                                        <a href="javascript:;" class="choose-theme" elements-theme="default" layout-theme="default" title="Default">
                                            <span style="background: #37485D;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="black" layout-theme="black" title="Black">
                                            <span style="background: #333;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="orange" layout-theme="gray" title="Gray">
                                            <span style="background: #4a4a4a;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="blue-dark" layout-theme="gray-light" title="Gray Light">
                                            <span style="background: #eee;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="green" layout-theme="white" title="White">
                                            <span style="background: #fafafa;"></span>
                                        </a>
                                    </div>

                                    <div class="bg-gray text-transform-upr font-size-12 font-bold font-gray-dark pad10A">Elements Color Schemes:</div>
                                    <div class="pad10A clearfix change-layout-theme">
                                        <p class="font-gray-dark font-size-11 pad0B">When you select a layout color scheme the elements inherit the styles from it, but you can also choose a different color scheme only for elements.</p>
                                        <div class="divider mrg10T mrg10B"></div>
                                        <a href="javascript:;" class="choose-theme" elements-theme="default" layout-theme="" title="Default">
                                            <span style="background: #37485d;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="black" layout-theme="" title="Black">
                                            <span style="background: #333;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="blue-light" layout-theme="" title="Blue Light">
                                            <span style="background: #45b3ff;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="blue-dark" layout-theme="" title="Blue Dark">
                                            <span style="background: #0068c0;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="orange" layout-theme="" title="Orange">
                                            <span style="background: #f3491c;"></span>
                                        </a>
                                        <a href="javascript:;" class="choose-theme" elements-theme="green" layout-theme="" title="Green">
                                            <span style="background: #269100;"></span>
                                        </a>
                                    </div>
                                    <div class="pad10A button-pane button-pane-alt text-center">
                                        <a href="aui_theming.html" class="btn medium bg-black">
                                            <span class="button-content text-transform-upr font-bold font-size-11">Example button</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- #page-header -->