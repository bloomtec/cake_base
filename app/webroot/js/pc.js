var pc = {};
$(function() {
	pc.checkItem = function(item , errorMessage, callback){
		//'processors','board-cards','ram-cards','hard-drives','video-cards','cases','supplies','optical-drives','monitors','peripherals','other-cards','accesories',
		if(errorMessage==null || typeof(errorMessage) == 'undefined'){
			switch(item){
				case '.board-cards':
					errorMessage = '<p>Debe Seleccionar una Tarjeta Madre</p>';
				break;
				case '.ram-cards':
					errorMessage = '<p>Debe Seleccionar una Tarjeta de Memoria</p>';
				break; 
				default:
					errorMessage = '<p>Faltan Items por seleccionar</p>';
				break; 
			}
		}
		
		var itemId = $(item+" input:checked").length > 0 ? $(item+" input:checked").attr('value') : 0;
		if(itemId){//selecciono el procesador cargar datos de tarjetas de video
			
			if(arguments.length >= 3){
				return	callback;	
			}else{
				$('.pc-error').html('').hide();
				return true;
			}	
		}else{// no selecciono el procesador
			$('.pc-error').html(errorMessage).show();
			return false;
		}	
	}	
	pc.processorFunctionality = function(fromTab,toTab){
		return true;
	}
	
	pc.ramFuncionality = function(fromTab,toTab){
		return pc.checkItem('.board-cards');
	}
	
	pc.hardDriveFunctionality = function(fromTab,toTab){
		return pc.checkItem('.board-cards',null,pc.checkItem('.ram-cards'));
		
	}
	
	pc.videoCardFunctionality = function(fromTab,toTab){
		return pc.checkItem('.board-cards',null,pc.checkItem('.hard-drives'));
	
	}
	
	pc.caseFunctionality = function(fromTab,toTab){
		var isIncluded=false;
		var $return=false;
		BJS.getS('/products/isVideoIncluded/'+pc.board_id,null,function(data){
				isIncluded=data;
				if(isIncluded){
					$return = pc.checkItem('.board-cards',null,pc.checkItem('.hard-drives'));
				}else{
					$return  = pc.checkItem('.board-cards',null,
								pc.checkItem('.hard-drives',null,
									pc.checkItem('.video-cards','La tarjeta madre que incluyo no tiene video, debe seleccionar una tarjeta de video.')
								)
							); 
			}
		});
		return $return;
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
	

// INIT
	
	getProcessors($('#architecture').val()); // CARGA INFO POR DEFECTO

// IN TAB Procesadores y boards	
	$('#architecture').change(function(){
		getProcessors($(this).val());
	});
	
	$('.radios.processors input').live('click',function(){
		var $proccessors = $(this);
		var val=$proccessors.val();
		pc.proccessor_id=val;
		getMotherBoard(val);
	});
	
	$('.radios.board-cards input').live('click',function(){
		var $boards = $(this);
		var val=$boards.val();
		pc.board_id=val;
		boardCallBack(val);
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
			if($('.radios.processors :checked').val()){ 
				getMotherBoard($('.radios.processors :checked').val());
			}else{
				$('.radios.board-cards').html('<span class="no-items">No hay tarjetas disponibles</span>');
			}	
		});
	}
	function getMotherBoard($processorId){
		$('.radios.board-cards').load('/products/getMotherBoards/'+$processorId,function(){
			var board=$('.radios.board-cards :checked');
			var boardId = board.lenth > 0 ? board.val() : 0;
			boardCallBack(boardId)
		});
	}
	function boardCallBack(boardId){
		var ramCardsSelectedId = ($('.radios.ram-card :checked').length > 0) ? $('.radios.ram-card :checked').val() : 0 ;
		var hardDriveSelectedId = ($('.radios.hard-drives :checked').length > 0) ? $('.radios.hard-drives :checked').val() : 0 ;
		var videoCardSelectedId = ($('.radios.video-cards :checked').length > 0) ? $('.radios.video-cards :checked').val() : 0 ;
		var opticalDriveSelectedId = ($('.radios.optical-drives :checked').length > 0) ? $('.radios.optical-drives :checked').val() : 0 ;
		if(boardId) getRamCards(boardId, ramCardsSelectedId);
		if(boardId) getHardDrives(boardId  , hardDriveSelectedId);
		if(boardId) getVideoCards(boardId , videoCardSelectedId);
		if(boardId) getOpticalDrives(boardId, opticalDriveSelectedId );
	}
	function getRamCards(boardId,oldRamCardId){
		if(arguments.length <= 1){
			oldRamCardId=0;
		}
		$('.radios.ram-cards').load('/products/getMemories/'+boardId+"/"+oldRamCardId, function(){//traer torres compatibles
			// lo que dependa de la memoria ram
		});
	}
	function getHardDrives(boardId,oldHardDriveId){
		if(arguments.length <= 1){
			oldHardDriveId=0;
		}
		$('.radios.hard-drives').load('/products/getHardDrives/'+boardId+"/"+oldHardDriveId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	function getVideoCards(boardId,oldVideoCardId){
		if(arguments.length <= 1){
			oldVideoCardId = 0;
		}
		$('.radios.video-cards').load('/products/getVideoCards/'+boardId+"/"+oldVideoCardId, function(){//traer torres compatibles
			// lo que dependa de video cards
			var caseSelectedId = ($('.radios.cases :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
			var videoSelectedCardId = $('.radios.video-cards :checked').val();
			getCases(videoSelectedCardId,caseSelectedId);
		});
	}
	function getCases($videoCardId, $oldCaseId){
		if(arguments.length <= 1){
			$oldCaseId = 0;
		}
		$('.radios.cases').load('/products/getCases/'+$videoCardId+'/'+$oldCaseId,function(){
			// lo que dependa de la caja
			var supplySelectedId = ($('.radios.supplys :checked').length) > 0 ? $('.radios.supplys :checked').val() : 0 ;
			var caseSelectedId = $('.radios.cases :checked').val();
			getSupply($videoCardId, caseSelectedId, supplySelectedId);
		});
	}
	function getSupply($videoCardId, $caseId , $oldSupplyId){
		if(arguments.length < 3){
			$oldSupplyId = 0;
		}
		$('.radios.supplys').load('/products/getPowerSupplies/'+$videoCardId+'/'+$caseId+'/'+$oldSupplyId,function(){
			//lo que dependa de la fuente
		});
	}
	function getOpticalDrives(boardId,oldOpticalDriveId){
		if(arguments.length < 2){
			oldOpticalDriveId = 0;
		}
		$('.radios.optical-drives').load('/products/getOpticalDrives/'+boardId+"/"+oldOpticalDriveId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	
	function getMonitors(oldMonitorId){
		if(arguments.length < 1){
			oldMonitorId=0;
		}
		$('.radios.monitors').load('/products/getMonitors', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})
	}
	
	function getPeripherals(peripheralsSelected){
		if(arguments.length < 1){
			peripheralsSelected=0;
		}
		$('.radios.peripherals').load('/products/getPeripherals', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})	
	}
	function getOtherCards(boardId, otherCardsSeleccted){
		if(arguments.length < 2){
			otherCardsSeleccted=0;
		}
		$('.radios.other-cards').load('/products/getOtherCards/'+boardId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	function getAccesories(accesoriesSelected){
		if(arguments.length < 1){
			accesoriesSelected=0;
		}
		$('.radios.accesories').load('/products/getAccesories', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})	
	}
	
});