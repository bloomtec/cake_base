$(function(){
	$("#ProductProductTypeId").change(function(){
		$("#ProductProductTypeInfo").load("add_processor");
	});
});