$(function(){
	var BJS={};
	BJS.get = function(url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.post = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "POST",
			cache: false,
			data: params,
			success: callback
		});
	}
	BJS.JSON = function (url,params,callback){
		jQuery.ajax({
			url:url,
			type: "GET",
			cache: false,
			dataType:"json",
			data: params,
			success: callback
		});
	}
	BJS.center=function(){
		var siteHeight=600;
		var windowHeight=$(window).height();
		if(windowHeight>siteHeight){
			var diferencia=windowHeight-siteHeight;
			var marginTop=diferencia/2;
			$("#container").css({"margin-top":marginTop}).fadeIn("slow");
		}
	}
	BJS.verticalCenter=function(selector){
		var $node=$(selector);
		var $container=$node.parent();
		var containerHeight=$container.height()-30/*los 30 que mide el footer*/;
		var nodeHeight=$node.height();
		var marginTopNode=(containerHeight>nodeHeight)?(containerHeight-nodeHeight)/2:0;
		$node.css({"marginTop":marginTopNode});
	}
	BJS.verticalCenter("#container");
//FUNCIONAMIENTO LOGO
	$("#container-logo").click(function(){
		$(this).hide("slow");
		$("#container").show("slow");
	});
	$("#pitaya-footer img").click(function(){
		$("#container").hide("slow");
		$("#container-logo").show("slow");
	});
	$("ul#footer li a").click(function(e){
		e.preventDefault();
		if($("#container").css('display')=='none'){
			$("#container-logo").hide("slow");
			$("#container").show("slow");
		}
	});
//SUPERSIZE
			$.supersized({
			// Functionality
			slide_interval : 3000, // Length between transitions
			transition : 1, // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
			transition_speed : 700, // Speed of transition
			// Components
			slide_links : 'blank', // Individual links for each slide (Options: false, 'number', 'name', 'blank')
			slides : imagenes,
			progress_bar: 0
			}); 
// MENU LIKE TABS
	$(function(){
		$("ul.menu").tabs("#content", {effect: 'ajax', history: true});
		//$("ul#footer").tabs("#content", {effect: 'ajax'});
	});
//SLIDE
	
});