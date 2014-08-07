var lang_short = "de";
var data;
var dictionary = ["Spott","Taunt","Spell","Zauber"];

jQuery(function ($) {
  /*Setze Sprache*/
  if (typeof window.document.get["lang"] === "undefined") var lang = "de_DE";
  else if (window.document.get["lang"] == "en") var lang = "en_US";
  else var lang = "de_DE";
  lang_short = lang.substring(0,2);
  $("html").attr("lang",lang);
  $("body").addClass(lang);
  
  for (var i = 0; i < cards.length; i++) {
	dictionary.push(cards[i]["name_de"]);
	dictionary.push(cards[i]["name_en"]);
  }

  /*Formularevents*/
  $("INPUT[type='search']").on("keyup",function() { autocomplete($(this).val()); draw(); });
  $(document).on("click","ul.search_autocomplete > li", function() { var a =$(this).text(); $("INPUT[type='search']").val(a); $("ul.search_autocomplete").html(''); draw(); });
  
  $(".manawahl > span").click(function() {
	var a = $(this).attr("data-value");
	$(".manawahl > span").removeClass("active");
	$(this).addClass("active");
	draw();
  });
  
  $(document).on("click","ul.allcards > li",function() {
	var card_id = parseInt($(this).attr("data-id"));
	var d = data;
	var j =false;
		for (var i = 0; i < d["cards"].length; i++) {
			if (d["cards"][i]["id"] == card_id) {
				if (typeof window.document.get["arena"] !== "undefined" && window.document.get["arena"] == "0") d["cards"][i]["anzahl"] = Math.min(2,d["cards"][i]["anzahl"]+1);
				else d["cards"][i]["anzahl"]++;
				j = true;
				break; 
				}
		}
	var d2 = { "id": card_id, "anzahl": 1 };
	if (!j) d["cards"].push(d2);
	var url = reparser(d);
	document.location.hash = url;
  });
  
  $(document).on("click", "ul.selcards > li", function() {
	var card_id = parseInt($(this).attr("data-id"));
	var d = data;
		for (var i = 0; i < d["cards"].length; i++) {
			if (d["cards"][i]["id"] == card_id) {
				d["cards"][i]["anzahl"]--;
				break; 
				}
		}
	var url = reparser(d);
	document.location.hash = url;
  });
  
  $(".deckhead span.name").click(function() {
	$(this).hide();
	$(".deckhead INPUT").show();
  });
  
  $(".deckhead INPUT").blur(function() {
	data["deck_name"] = $(this).val();
	var url = reparser(data);
	document.location.hash = url;
	$(this).hide();
	$(".deckhead span.name").show();
  });
  
  $(".socialbuttons button.counter").click(function() {
	var url = reparser(data);
	document.location.href = "counter.html#"+url;
  });
  
  
  
  
  $(window).on('hashchange', function() {
	draw();
  });
  draw();
});

function draw() {
	var b = parser();
	data = b;
	if (data["class"]==0) {$("section.chooseclass").addClass("active"); $("section.choosecards").removeClass("active"); }else{ $("section.chooseclass").removeClass("active"); $("section.choosecards").addClass("active");}
	
	if (data["class"] > 0) {
		$(".deckhead").attr("data-class", data["class"]);
		$(".deckhead span.name").text(data["deck_name"]);
		$(".deckhead INPUT[name='name']").val(data["deck_name"]);
	
		var query = $("INPUT[type='search']").val();
		var manaw = $(".manawahl > span.active").attr("data-value");
	
		var c = $("<ul/>");
		for (var i = 0; i < cards.length; i++) {
			if (cards[i]["class"] > 0 && cards[i]["class"] != data["class"]) continue;
			if (cards[i]["name_de"].indexOf(query) == -1 && cards[i]["name_en"].indexOf(query) == -1) continue
			if (manaw != "" && manaw != cards[i]["mana"] && (manaw != 7 || cards[i]["mana"] < 7)) continue;
			var b2 = $('<li/>');
			b2.addClass("card"+cards[i]["id"]).attr("data-id",cards[i]["id"]).attr("title",cards[i]["name_"+lang_short]);
			c.append(b2);
		}
		$("ul.allcards").html(c.html());
	}
	
	var stats = {minion:0,spell:0};
	var c2 = $("<ul/>");
	var cardsumme = 0;
	for (var i = 0; i < b["cards"].length; i++) {
		var c = $('<li><span class="cardname"/><span class="anzahl"></span></li>');
		$(c).attr("data-id",b["cards"][i]["id"]).addClass("card"+b["cards"][i]["id"]);
		$(c).attr("data-anzahl",b["cards"][i]["anzahl"]).find(".anzahl").attr("data-value",b["cards"][i]["anzahl"]).addClass("anzahl"+b["cards"][i]["anzahl"]).text(b["cards"][i]["anzahl"]);
		$(c).attr("title", b["cards"][i]["name"]).find(".cardname").text(b["cards"][i]["name"]);
		if (typeof b["cards"][i]["minion"] !== "undefined" && b["cards"][i]["minion"] == true) stats["minion"]+=b["cards"][i]["anzahl"];
		if (typeof b["cards"][i]["spell"] !== "undefined" && b["cards"][i]["spell"] == true) stats["spell"]+=b["cards"][i]["anzahl"];
		$(c2).append(c);
		cardsumme += b["cards"][i]["anzahl"]; 
	}
	$("ul.selcards").html(c2.html());
	$("div.cardcount span.value").text(cardsumme);
	$("ul.stats li.minion .value").text(stats["minion"]);
	$("ul.stats li.spell .value").text(stats["spell"]);
}

function parser() {
	var out = {};
	var regex = /c(\d)(;([^;]*)(;(.*))?)?/gi;
	var match = regex.exec(document.location.hash);
	if (match == null) return {class:0,deck_name:"",cards:[]};
	out["class"] = match[1];
	if (typeof match[3] === "undefined") out["deck_name"] = ""; else out["deck_name"] = match[3];
	out["cards"] = [];
	if (typeof match[5] === "undefined" || match[5] == "") return out;
	var g = match[5].split(";");
	for (var i = 0; i < g.length; i++) {
		var regex = /([0-9]{1,3}):([0-9]+)/gi;
		var match = regex.exec(g[i]);
		if (match ==null) continue;
		if (typeof window.document.get["arena"] !== "undefined" && window.document.get["arena"] == "0") match[2] = Math.min(2,parseInt(match[2]));
		var b = { id: parseInt(match[1]), anzahl: parseInt(match[2])};
		var d = get_carddata(b["id"]);
		if (d["class"] > 0 && out["class"] != d["class"]) continue;
		if (d == null) continue;
		else {
			b = $.extend(b,d);
			b["name"] = d["name_"+lang_short];
			}
		out["cards"].push(b);
	}
	return out;
}

function autocomplete( str) {
	var strl = str.toLowerCase();
	var o = $("<ul/>");
	var i2=0;
	if (str.length > 0)
	for (var i = 0; i < dictionary.length; i++) {
		if (dictionary[i].toLowerCase().indexOf(strl) > -1) {
		var b = $("<li/>");
		b.text(dictionary[i]);
		o.append(b);
		i2++;
		if (i2 > 10) break;
		}
	}
	$("ul.search_autocomplete").html(o.html());
}

function reparser(d) {
	var g = [];
	for (var i = 0; i < d["cards"].length; i++) {
		g.push(d["cards"][i]["id"]+":"+d["cards"][i]["anzahl"]);
	}
	return "c"+d["class"]+";"+d["deck_name"]+";"+g.join(";");
} 

function get_carddata(id) {
	for (var i = 0; i < cards.length; i++) {
		if(cards[i]["id"] == id) return cards[i];
	}
	return null;
}