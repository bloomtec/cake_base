$(function(){
	/**
	 * SORTABLE
	 */
	var sendData=function(order,controller){
    var data={};
    for(i=0;i<order.length;i+=1){
      data["data[Item]["+order[i]+"]"]=(i+1);
    }
    $.post("/admin/"+controller+"/reOrder",
        data,
        function(response){
          if(response){
            for(i=0;i<order.length;i+=1){
              $("tr#"+order[i]).children(".sort").text(i+1);
            }
          }
        }
    );
    }
    // ul sortables (galerias)
	$("ul#sortable").sortable({
		revert:true,
		 update:function(event, ui){
      		sendData($(this).sortable("toArray"),$(this).attr("controller"));
    	}
	});
	$("ul#sortable").disableSelection();
	// tablas sortables
	$("#sortable tbody").sortable({
		revert: true,
      	items:"tr:not(.ui-state-disabled)",
		 update:function(event, ui){
      		sendData($(this).sortable("toArray"),$(this).parent().attr("controller"));
    	}
	});
	$("table#sortable tbody > tr").disableSelection();
})
