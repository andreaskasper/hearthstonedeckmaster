/*Bitte zuerst mit dem Closure-Compiler noch vebessern!!!*/




jQuery(document).ready(function($) {
	/*Ersetzen wir mal die Karten*/
	var add_html = "";
	var is_cardtooltip = ",";
	$("body").html($("body").html().replace(/\[htcard=?\"?(.*?)\"?\](.*?)\[\/htcard\]/g,function(match,cont1, cont2, offset, s) {
		if (cont1 == "") cont1 = cont2;
		for (var i = 0; i < hearthstone_cards.length; i++) {
			var row = hearthstone_cards[i];
			if (row.id == cont1 || row.name_de == cont1 || row.name_en == cont1) {
				if (is_cardtooltip.indexOf(","+row.id+",") < 0) {
					add_html +='<div class="hearthstone_tooltip_card card'+row.id+'" style="display:none; position: absolute;"><img src="//hearthstone.justnetwork.eu/img/cards/de/'+row.id+'n.png"/></div>';
					is_cardtooltip += row.id+",";
					}
				return '<a class="hearthstone_inline_card card'+row.id+'" data-card-name="'+row.name_en+'" data-card-id="'+row.id+'" href="#">'+cont2+'</a>';
			}
		}
		$.post("//hearthstone.justnetwork.eu/newcard.php",{"q": cont1});
		return '<span class="new_hearthstone_card">'+cont2+'</span>';
	}));
	/*Jetzt kommt das htdeck*/
	$("body").html($("body").html().replace(/\[htdeck=\"(.*?)\"( left| right)?\/\]/g,function(match,cont1,cont2, offset, s) {
		var output = '<div class="hearthstone_deck '+cont2+'" style="display:inline-block">';
		var g = cont1.split(";");
		switch (g[0]) {
			case "Druid": case "Druide": case "c6": output += '<div class="classheader class_druid"><span class="name">'+g[1]+'</span></div>'; break;
			default: output += '<div class="classheader"><span class="name">'+g[1]+'</span></div>';
		}
		for (var i2 = 2; i2 < g.length; i2++) {
			var g2 = g[i2].split(":");
			var j = false;
			for (var i = 0; i < hearthstone_cards.length; i++) {
				var row = hearthstone_cards[i];
				if (row.id == g2[0] || row.name_de == g2[0] || row.name_en == g2[0]) {
					if (is_cardtooltip.indexOf(","+row.id+",") < 0) {
						add_html +='<div class="hearthstone_tooltip_card card'+row.id+'" style="display:none; position: absolute;"><img src="//hearthstone.justnetwork.eu/img/cards/de/'+row.id+'n.png"/></div>';
						is_cardtooltip += row.id+",";
						}
					output += '<div class="cardrow" data-card-id="'+row.id+'" style="background-image:url(//hearthstone.justnetwork.eu/img/cardrow/de/'+row.id+'.png);">';
					if (g2[1] > 1) output += '<span class="quantity">'+g2[1]+'</span>';
					output += '</div>';
					j = true;
					break;
				}
			}
			if (!j) $.post("//hearthstone.justnetwork.eu/newcard.php",{"q": g2[0]});
		}
		output += '</div>';
		return output;
	}));
	/*Hover für die Inline-Cards*/
	$("a.hearthstone_inline_card").on("mousemove", function(e) {
		$(".hearthstone_tooltip_card.active").css({
			left:  e.pageX+5,
			top:   e.pageY+5
		});
	});
	$("a.hearthstone_inline_card").hover(function() {
		var a = $(this).attr("data-card-id");
		$(".hearthstone_tooltip_card.card"+a).addClass("active").fadeIn(200);
		}, function() {
		$(".hearthstone_tooltip_card").removeClass("active").fadeOut(200);
	});
	/*Hover für die Deck-Cards*/
	$(".hearthstone_deck > .cardrow").on("mousemove", function(e) {
		$(".hearthstone_tooltip_card.active").css({
			left:  e.pageX+5,
			top:   e.pageY+5
		});
	});
	$(".hearthstone_deck > .cardrow").hover(function() {
		var a = $(this).attr("data-card-id");
		$(".hearthstone_tooltip_card.card"+a).addClass("active").fadeIn(200);
		}, function() {
		$(".hearthstone_tooltip_card").removeClass("active").fadeOut(200);
	});
	/*Jetzt nur noch die Tooltips*/
	$("body").append(add_html);
});