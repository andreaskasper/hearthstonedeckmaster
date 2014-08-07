var lang_short = "de";
var data;

jQuery(function ($) {
  /*Setze Sprache*/
  if (typeof window.document.get["lang"] === "undefined") var lang = "de_DE";
  else if (window.document.get["lang"] == "en") var lang = "en_US";
  else var lang = "de_DE";
  lang_short = lang.substring(0,2);
  $("html").attr("lang",lang);
  $("body").addClass(lang);

  $( document ).on("click","ul.cards > li",function() {
		var card_id =$(this).attr("data-id");
		var d = data;
		for (var i = 0; i < d["cards"].length; i++) {
			if (d["cards"][i]["id"] == card_id && d["cards"][i]["anzahl"] >0) {d["cards"][i]["anzahl"]--; break; }
		}
		var url = reparser(d);
		document.location.hash = url;
	});
	
	$( document ).on("contextmenu","ul.cards > li",function() {
		if (data["summe"] >= 30) return false;
		var card_id =$(this).attr("data-id");
		var d = data;
		for (var i = 0; i < d["cards"].length; i++) {
			if (d["cards"][i]["id"] == card_id) {
				if (typeof window.document.get["arena"] !== "undefined" && window.document.get["arena"] == "0") d["cards"][i]["anzahl"] = Math.min(2,d["cards"][i]["anzahl"]+1);
				else d["cards"][i]["anzahl"]++; 
				break; 
				}
		}
		var url = reparser(d);
		document.location.hash = url;
		return false;
	});
	
	$("body").append('<div class="hovercard" style="display:none;"></div>');
	$(document).on("mousemove","ul.cards",function(e) {
		var x = e.pageX+10;
        var y = e.pageY+5;
		$("div.hovercard").css("left",x+"px").css("top",y+"px");
	});
	$(document).on("mouseover","ul.cards li",function() {
		$("div.hovercard").css("display","block").attr("data-card",$(this).attr("data-id"));
		
	});
	$(document).on("mouseout","ul.cards ",function() {
		$("div.hovercard").css("display","none");
	});
	/*$("div.hovercard").qtip({
         content: 'Mouse tracking!',
         position: {
             target: 'mouse', // Track the mouse as the positioning target
             adjust: { x: 5, y: 5 } // Offset it slightly from under the mouse
         }
     });*/
  
  
  
  
  $(window).on('hashchange', function() {
	draw();
  });
  draw();
});

function draw() {
	var b = parser();
	data = b;
	$(".deckhead .name").text(b["deck_name"]);
	$(".deckhead").attr("data-class",b["class"]);
	$("ul.cards").html();
	var c2 = $("<ul/>");
	var cardsumme = 0;
	for (var i = 0; i < b["cards"].length; i++) {
		cardsumme += b["cards"][i]["anzahl"]; 
	}
	$(".deckhead .cardcount .amount").text(cardsumme);
	
	data["summe"] = cardsumme;
	
	if (cardsumme < 1) cardsumme = 1;
	
	
	for (var i = 0; i < b["cards"].length; i++) {
		var c = $('<li><span class="cardname"/><span class="prozent"></span><span class="anzahl"></span></li>');
		$(c).attr("data-id",b["cards"][i]["id"]).addClass("card"+b["cards"][i]["id"]);
		$(c).attr("data-anzahl",b["cards"][i]["anzahl"]).find(".anzahl").attr("data-value",b["cards"][i]["anzahl"]).addClass("anzahl"+b["cards"][i]["anzahl"]).text(b["cards"][i]["anzahl"]);
		$(c).attr("title", b["cards"][i]["name"]).find(".cardname").text(b["cards"][i]["name"]);
		$(c).find(".prozent").attr("data-value",Math.round(100*b["cards"][i]["anzahl"]/cardsumme)).text((100*b["cards"][i]["anzahl"]/cardsumme).toFixed(1)+"%");
		$(c2).append(c);
	}
	$("ul.cards").html(c2.html());
}

function parser() {
	var out = {};
	var regex = /c(\d)(;([^;]*)(;(.*))?)?/gi;
	var match = regex.exec(document.location.hash);
	if (match == null) return {class:0,deck_name:"",cards:[]};
	out["class"] = match[1];
	out["deck_name"] = match[3];
	out["cards"] = [];
	if (typeof match[5] === "undefined") return out;
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
			b["name"] = d["name_"+lang_short];
			}
		out["cards"].push(b);
	}
	return out;
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