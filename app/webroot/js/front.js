$(function(){
BJS={};
BJS.verticalCenter=function(selector){
	var $node=$(selector);
	var $container=$node.parent();
	var containerHeight=$container.height();
	var nodeHeight=$node.height();
	var marginTopNode=(containerHeight>nodeHeight)?(containerHeight-nodeHeight)/2:0;
	$node.css({"marginTop":marginTopNode});
}

$(".scrollable").scrollable();

});