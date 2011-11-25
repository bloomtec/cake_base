$(function(){
	
// MANEJO DE EVENTO DE TABLA
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div",function(e,index){
		var toTab= this.getTabs().eq(index);
		var fromTab = this.getCurrentTab();
		switch(toTab.attr('id')){
			case 'processor':
				pc.processorFunctionality(fromTab,toTab);
			break;
			
			case 'ram-cards':
				return pc.ramFuncionality(fromTab,toTab);
			break;
			
			case 'hard-drive':
				return pc.hardDriveFunctionality(fromTab,toTab);
			break;
						
			case 'video-card':
				return pc.videoCardFunctionality(fromTab,toTab);
			break;
			case 'case':
				return pc.caseFunctionality(fromTab,toTab);
			break;
			case 'supply':
				return pc.supplyFunctionality(fromTab,toTab);
			break;
			case 'optical-drive':
				return pc.opticalDriveFunctionality(fromTab,toTab);
			break;
			case 'monitor':
				return pc.monitorFunctionality(fromTab,toTab);
			break;
			case 'peripherals':
				return pc.mouseFunctionality(fromTab,toTab);
			break;
			case 'other-cards':
				return pc.otherCardFunctionality(fromTab,toTab);
			break;
			case 'accesories':
				return pc.accesoriesFunctionality(fromTab,toTab);
			break;
		}
	});
	// INICIO DE INTERFAZ GRAFICA	
	$(".scrollable").scrollable();
	var tabsApi = $("ul.tabs").data("tabs");
	$('.siguiente_paso').click(function(){
		tabsApi.next();
	});
	$('.paso_anterior').click(function(){
		tabsApi.prev();
	});
	$('.browse a').click(function(e){
		e.preventDefault();
	});
	$('.radios input').live('click',function(){
		$('.pc-error').html('').hide();	
	});
});
