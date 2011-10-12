$(function(){
	//Validator
	
	
	$('.caratulas li').click(function(){
		$("#background").html('<img src="/img/uploads/'+$(this).attr('rel')+'"/>');
	});
	$('.horarios li').click(function(){
		$("#horarios").html('<img src="/img/uploads/'+$(this).attr('rel')+'"/>');
	});
	$('.minuteros li').click(function(){
		$("#minuteros").html('<img src="/img/uploads/'+$(this).attr('rel')+'"/>');
	});
	$("form").validator();
	
});
