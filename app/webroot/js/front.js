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
	var containerHeight=$container.height();
	var nodeHeight=$node.height();
	var marginTopNode=(containerHeight>nodeHeight)?(containerHeight-nodeHeight)/2:0;
	$node.css({"marginTop":marginTopNode});
}
//SUPERSIZE
	

//SLIDE
	$(".scrollable").scrollable();
});