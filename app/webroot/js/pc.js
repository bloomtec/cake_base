$(function() {
	function checkBoardProcessor(callback,error){
		var proccesorId = $(".processors input:checked").length > 0 ? $(".processors input:checked").attr('value') : 0;
		var boardId = $(".boards input:checked").length > 0 ? $(".processors input:checked").attr('value') : 0;
		var thisArguments = arguments.length;
		if(proccesorId && boardId){//selecciono el procesador cargar datos de tarjetas de video
			$('.pc-error').html('').hide();	
			callback();
			
		}else{// no selecciono el procesador
			$('.pc-error').html('Debes seleccionar un procesador y una tarjeta').show();
			if(thisArguments == 2) error(); 
			return false;
		}	
	}
	
	var pc = {};
	$("input[name='data[processor_id]']").live('click',function(){
		
	});
	
	pc.processorFunctionality = function(currentTab){
		
	}
	
	pc.ramFuncionality = function(currentTab){
		return checkBoardProcessor(
			function(){
				
			}
		);
	}
	
	pc.discoDuroFunctionality = function(currentTab){
		var videoCardSelectedId = ($('.radios.video-cards :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
		var isRequerided=false;
		if(videoCardSelectedId){
			isRequerided = BJS.get('/products/isVideo',null,function(data){
				
			});
		}
	}
	
	pc.tarjetaVideoFunctionality = function(currentTab){
		checkBoardProcessor(
			function(){
				
			}
		);
	}
	
	pc.torreFunctionality = function(currentTab){
	
	}
	
	pc.fuenteFunctionality = function(currentTab){
	
	}
	
	pc.unidadOpticaFunctionality = function(currentTab){
	
	}
	
	pc.monitorFunctionality = function(currentTab){
	
	}
	
	pc.mouseFunctionality = function(currentTab){
	
	}
	
	pc.tarjetasAdicionalesFunctionality = function(currentTab){
	
	}
	
	pc.accesoriosFunctionality = function(currentTab){
	
	}
	
	// setup ul.tabs to work as tabs for each div directly under div.panes
	$("ul.tabs").tabs("div.panes > div",function(e,index){
		var tab=this.getTabs().eq(index).attr('id');
		var currentTab = this.getCurrentTab();
		switch(tab){
			case 'processor':
				pc.processorFunctionality(currentTab);
			break;
			
			case 'ram':
				return pc.ramFuncionality(currentTab);
			break;
			
			case 'hard-disc':
				return pc.discoDuroFunctionality(currentTab);
			break;
						
			case 'tarjeta-video':
				return pc.tarjetaVideoFunctionality(currentTab);
			break;
			case 'torre':
				return pc.torreFunctionality(currentTab);
			break;
			case 'fuente':
				return pc.fuenteFunctionality(currentTab);
			break;
			case 'unidad-optica':
				return pc.unidadOpticaFunctionality(currentTab);
			break;
			case 'monitor':
				return pc.monitorFunctionality(currentTab);
			break;
			case 'mouse':
				return pc.mouseFunctionality(currentTab);
			break;
			case 'tarjetas-adicionales':
				return pc.tarjetasAdicionalesFunctionality(currentTab);
			break;
			case 'accesorios':
				return pc.accesoriosFunctionality(currentTab);
			break;
		}
	});
// INIT
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
// IN TAB 1
	getProcessors($('#architecture').val()); // CARGA INFO POR DEFECTO
	
	$('#architecture').change(function(){
		getProcessors($(this).val());
	});
	
	
	$('.radios.processors input').live('click',function(){
		var $proccessorId = $(this);
		getMotherBoard($proccessorId.val());
	});
	$('.radios input').live('click',function(){
		$('.pc-error').html('').hide();	
	});
// IN TAB 2
	function getProcessors($architectureId){
		$('.radios.processors').load('/products/getProcessors/'+$architectureId,function(){
			getMotherBoard($('.radios.processors :checked').val());	
		});
	}
	function getMotherBoard($processorId){
		$('.radios.boards').load('/products/getMotherBoards/'+$processorId,function(){
			videoCardSelectedId = ($('.radios.video-cards :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
			getVideoCards($('.radios.boards :checked').val() , videoCardSelectedId);
		});
	}
	function getVideoCards(boardId,oldVideoCardId){
		$('.radios.video-cards').load('/products/getVideoCards/'+boardId+"/"+oldVideoCardId, function(){//traer torres compatibles
			caseSelectedId = ($('.radios.cases :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
			getCases($('.radios.video-cards :checked'),caseSelectedId);
		});
	}
	function getCases($videoCardId, $oldCaseId){
		$('.radios.cases').load('/products/getCases/'+$videoCardId+'/'+$oldCaseId);
	}

});