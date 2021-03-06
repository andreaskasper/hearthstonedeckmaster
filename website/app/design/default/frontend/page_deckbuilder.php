<?php
PageEngine::html("html_head");
PageEngine::html("header");
PageEngine::html("breadcrumbs");
?>
<script type="text/javascript" src="/skins/aui/js/deckbuilder.js"></script>
<link rel="stylesheet" type="text/css" href="/skins/aui/css/deckbuilder.css">
<div id="page-content">
                    
<section class="chooseclass">
	<h1>Klassenauswahl</h1>
	<div>
		<a href="#c1;;" class="class1">Krieger</a>
		<a href="#c2;;" class="class2">Schamane</a>
		<a href="#c3;;" class="class3">Schurke</a>
		<a href="#c4;;" class="class4">Paladin</a>
		<a href="#c5;;" class="class5">Jäger</a>
		<a href="#c6;;" class="class6">Druide</a>
		<a href="#c7;;" class="class7">Hexenmeister</a>
		<a href="#c8;;" class="class8">Magier</a>
		<a href="#c9;;" class="class9">Priester</a>
	</div>
	</section>
	<section class="choosecards">
		<div class="header">
		<a href="#" class="class" title="zurück zur Klassenwahl"></a>
		<INPUT type="search" name="query"/><ul class="search_autocomplete"></ul>
		<ul class="manawahl">
			<li class="mana manaall active" data-value="">alle</li>
			<li class="mana mana0" data-value="0">0</li>
			<li class="mana mana1" data-value="1">1</li>
			<li class="mana mana2" data-value="2">2</li>
			<li class="mana mana3" data-value="3">3</li>
			<li class="mana mana4" data-value="4">4</li>
			<li class="mana mana5" data-value="5">5</li>
			<li class="mana mana6" data-value="6">6</li>
			<li class="mana mana7" data-value="7">7+</li>
		</ul>
		<ul class="cardgroup">
			<li class="class">Klasse</li>
			<li class="neutral">Neutral</li>
			<li class="naxxramas">Naxxramas</li>
		</ul>
		</div>
		<ul class="allcards">
		</ul>
		<div class="deckhead">
			<span class="name"></span>
			<INPUT type="text" name="name" placeholder="Mein Deck"/>
		</div>
		<div class="managraph">
			<div class="mana0"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana1"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana2"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana3"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana4"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana5"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana6"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
			<div class="mana7"><span class="anzahl">0</span><div class="progress"><div class="v1"></div><div class="v2"></div></div></div>
		</div>
		<ul class="selcards"></ul>
		<div class="cardcount"><span class="value">0</span>/30</div>
		<div class="socialbuttons"><button class="counter">in den Counter übertragen</button><button class="facebook">Facebook</button><button class="twitter">Twitter</button></div>
		<ul class="stats">
			<li class="minion type0" data-key="minion"><label>Diener:</label><span class="value">0</span></li>
			<li class="spell type0" data-key="spell"><label>Zauber:</label><span class="value">0</span></li>
			<li class="weapon type0" data-key="weapon"><label>Waffen:</label><span class="value">0</span></li>
			<li class="battlecry" data-key="battlecry"><label>Kampfschrei:</label><span class="value">0</span></li>
			<li class="stealth" data-key="stealth"><label>Verstohlenheit:</label><span class="value">0</span></li>
			<li class="charge" data-key="charge"><label>Ansturm:</label><span class="value">0</span></li>
			<li class="deathrattle" data-key="deathrattle"><label>Todesschrei:</label><span class="value">0</span></li>
			<li class="shield" data-key="shield"><label>Schild:</label><span class="value">0</span></li>
			<li class="enrage" data-key="enrage"><label>Enrage:</label><span class="value">0</span></li>
			<li class="freeze" data-key="freeze"><label>Freeze:</label><span class="value">0</span></li>
			<li class="overload" data-key="overload"><label>Überladen:</label><span class="value">0</span></li>
			<li class="secret" data-key="secret"><label>Geheimnis:</label><span class="value">0</span></li>
			<li class="silence" data-key="silence"><label>Stille:</label><span class="value">0</span></li>
			<li class="spelldmg" data-key="spelldmg"><label>Spell Damage:</label><span class="value">0</span></li>
			<li class="summon" data-key="summon"><label>Beschwörung:</label><span class="value">0</span></li>
			<li class="windfury" data-key="windfury"><label>Windzorn:</label><span class="value">0</span></li>
			<li class="taunt type2" data-key="taunt"><label>Spott:</label><span class="value">0</span></li>
			<li class="beast type2" data-key="beast"><label>Wildtier:</label><span class="value">0</span></li>
			<li class="demon type2" data-key="demon"><label>Dämon:</label><span class="value">0</span></li>
			<li class="dragon type2" data-key="dragon"><label>Drache:</label><span class="value">0</span></li>
			<li class="murloc type2" data-key="murloc"><label>Murloc:</label><span class="value">0</span></li>
			<li class="pirate type2" data-key="pirate"><label>Pirat:</label><span class="value">0</span></li>
			<li class="totem type2" data-key="totem"><label>Totem:</label><span class="value">0</span></li>
		</ul>
	</section>



</div><!-- #page-content -->
<?php
PageEngine::html("html_footer");
?>

