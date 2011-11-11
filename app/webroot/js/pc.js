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
	
	pc.processorFunctionality = function(fromTab,toTab){
		
	}
	
	pc.ramFuncionality = function(fromTab,toTab){
		return checkBoardProcessor(
			function(){
				
			}
		);
	}
	
	pc.hardDriveFunctionality = function(fromTab,toTab){
		var videoCardSelectedId = ($('.radios.video-cards :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
		var isRequerided=false;
		if(videoCardSelectedId){
			isRequerided = BJS.get('/products/isVideo',null,function(data){
				
			});
		}
	}
	
	pc.videoCardFunctionality = function(fromTab,toTab){
		checkBoardProcessor(
			function(){
				
			}
		);
	}
	
	pc.caseFunctionality = function(fromTab,toTab){
	
	}
	
	pc.supplyFunctionality = function(fromTab,toTab){
	
	}
	
	pc.opticalDriveFunctionality = function(fromTab,toTab){
	
	}
	
	pc.monitorFunctionality = function(fromTab,toTab){
	
	}
	
	pc.mouseFunctionality = function(fromTab,toTab){
	
	}
	
	pc.otherCardFunctionality = function(fromTab,toTab){
	
	}
	
	pc.accesoriessFunctionality = function(fromTab,toTab){
	
	}
	
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
				return pc.tarjetaVideoFunctionality(fromTab,toTab);
			break;
			case 'case':
				return pc.videoCardFunctionality(fromTab,toTab);
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
	$('.radios input').live('click',function(){
		$('.pc-error').html('').hide();	
	});

	getProcessors($('#architecture').val()); // CARGA INFO POR DEFECTO

// IN TAB Procesadores y boards	
	$('#architecture').change(function(){
		getProcessors($(this).val());
	});
	
	$('.radios.processors input').live('click',function(){
		var $proccessorId = $(this);
		getMotherBoard($proccessorId.val());
	});
	
// IN TAB Memorias RAM
	
	
// IN TAB Discos duros	
	
	
// IN TAB Tarjestas de Video


// IN TAB Torres

	
// IN TAB Memorias Fuentes


// IN TAB Unidades Opticas


// IN TAB Monitores


// IN TAB Perifericos


// IN TAB otras tarjetas


// IN TAB accesorios
	
	
// FUNCIONES BASE	
	function getProcessors($architectureId){
		$('.radios.processors').load('/products/getProcessors/'+$architectureId,function(){
			getMotherBoard($('.radios.processors :checked').val());	
		});
	}
	function getMotherBoard($processorId){
		$('.radios.boards').load('/products/getMotherBoards/'+$processorId,function(){
			var ramCardsSelectedId = ($('.radios.ram-card :checked').length > 0) ? $('.radios.ram-card :checked').val() : 0 ;
			var hardDriveSelectedId = ($('.radios.hard-drives :checked').length > 0) ? $('.radios.hard-drives :checked').val() : 0 ;
			var videoCardSelectedId = ($('.radios.video-cards :checked').length > 0) ? $('.radios.video-cards :checked').val() : 0 ;
			var opticalDriveSelectedId = ($('.radios.optical-drives :checked').length > 0) ? $('.radios.optical-drives :checked').val() : 0 ;
			var boardId = $('.radios.boards :checked').val();
			getRamCards(boardId, ramCardsSelectedId);
			getHardDrives(boardId  , hardDriveSelectedId);
			getVideoCards(boardId , videoCardSelectedId);
			getOpticalDrives(boardId, opticalDriveSelectedId );
		});
	}
	function getRamCards(boardId,oldRamCardId){
		
		$('.radios.ram-cards').load('/products/getMemories/'+boardId+"/"+oldRamCardId, function(){//traer torres compatibles
			// lo que dependa de la memoria ram
		});
	}
	function getHardDrives(boardId,oldHardDriveId){
		$('.radios.hard-drives').load('/products/getHardDrives/'+boardId+"/"+oldHardDriveId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	function getVideoCards(boardId,oldVideoCardId){
		$('.radios.video-cards').load('/products/getVideoCards/'+boardId+"/"+oldVideoCardId, function(){//traer torres compatibles
			// lo que dependa de video cards
			var caseSelectedId = ($('.radios.cases :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
			var videoSelectedCardId = $('.radios.video-cards :checked').val();
			getCases(videoSelectedCardId,caseSelectedId);
		});
	}
	function getCases($videoCardId, $oldCaseId){
		$('.radios.cases').load('/products/getCases/'+$videoCardId+'/'+$oldCaseId,function(){
			// lo que dependa de la caja
			var supplySelectedId = ($('.radios.supplys :checked').length) > 0 ? $('.radios.supplys :checked').val() : 0 ;
			var caseSelectedId = $('.radios.cases :checked').val();
			getSupply($videoCardId, caseSelectedId, supplySelectedId);
		});
	}
	function getSupply($videoCardId, $caseId , $oldSupplyId){
		$('.radios.supplys').load('/products/getPowerSupplies/'+$videoCardId+'/'+$caseId+'/'+$oldSupplyId,function(){
			//lo que dependa de la fuente
		});
	}
	function getOpticalDrives(boardId,oldOpticalDriveId){
		$('.radios.optical-drives').load('/products/getOpticalDrives/'+boardId+"/"+oldOpticalDriveId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	
	function getMonitors(){
		$('.radios.monitors').load('/products/getMonitors', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})
	}
	
	function getPeripherals(){
		$('.radios.peripherals').load('/products/getPeripherals', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})	
	}
	function getOtherCards(boardId){
		$('.radios.other-cards').load('/products/getOtherCards/'+boardId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	function getAccesories(){
		$('.radios.accesories').load('/products/getAccesories', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})	
	}
	
});