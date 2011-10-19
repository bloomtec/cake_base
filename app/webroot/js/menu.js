$(function() {
	/**
	* menu
	*/
	
	$.each($('#main_menu li ul'),function(i,val){
		$(val).parent().addClass("desplegable");
	});
	/**
	 * SORTABLE
	 */
	var sendData=function(order,controller){
    var data={};
    for(i=0;i<order.length;i+=1){
      data["data[Item]["+order[i]+"]"]=(i+1);
    }
    $.post("/"+controller+"/reOrder",
        data,
        function(response){
          if(response=="yes"){
            for(i=0;i<order.length;i+=1){
              $("tr#"+order[i]).children(".order").text(i+1);
            }
          }
        }
    );
    }
	$( "#sortable" ).sortable({
		revert:true,
		 update:function(event, ui){
		 	//console.log(($(this).sortable("toArray")));
      		sendData($(this).sortable("toArray"),$(this).attr("controller"));
    	}
	});
	$( "#sortable" ).disableSelection();
	
});