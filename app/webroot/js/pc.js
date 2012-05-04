var pc = {};
$(function() {
	pc.checkItem = function(item , errorMessage, callback){
		//'processors','board-cards','ram-cards','hard-drives','video-cards','cases','supplies','optical-drives','monitors','peripherals','other-cards','accesories',
		if(errorMessage==null || typeof(errorMessage) == 'undefined'){
			switch(item){
				case '.board-cards':
					errorMessage = 'Debe Seleccionar una Tarjeta Madre';
				break;
				case '.ram-cards':
					errorMessage = 'Debe Seleccionar una Tarjeta de Memoria';
				break; 
				default:
					errorMessage = 'Faltan Items por seleccionar';
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
			if(errorMessage) $('.pc-error').html("<p>["+errorMessage+"]</p>").show();
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
		BJS.getS('/makePc/isVideoIncluded/'+pc.board_id,null,function(data){
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
	

	pc.opticalDriveFunctionality = function(fromTab,toTab){
		var $return = false;
		//VALIDAR SI LA FUENTE NO TIENE TORRE
		BJS.getS('/makePc/isSuplyIncluded/'+pc.board_id,null,function(data){
			if(data){
				$return = pc.checkItem('.cases','Debe seleccionar una torre.');
			}else{
				$return = pc.checkItem('.cases','Debe seleccionar una torre.',pc.checkItem('.supplies','La torre seleccionada no tiene fuente, debe seleccionar una.'))
			}
		});
		
		return $return;
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
	$('#resumen').load('/makePc/resume');
// IN TAB Procesadores y boards	
	$('#architecture').change(function(){
		getProcessors($(this).val());
	});
	var $item = val= position = sibling = removeChecked= null;
	$('.radios').on('mousedown','label',function(){
		$("#"+$(this).attr('for')).mousedown();
	});
	$(document).on('click','.radios input',function(){
		if(removeChecked){
			$(this).removeAttr('checked');
		}
	});
	$(document).on('mousedown','.radios input',function(){
		removeChecked=false;
		$item = $(this);
		var checked =$ (this).is(":checked");
		val=$item.val();
		position = $item.attr('rel')? $item.attr('rel') :0;
		rel=$item.parents().attr('rel');
		if($item.parent().is('.opcional') && checked){
			removeChecked = true;
			BJS.get('/makePc/myPCAddItem/'+rel+'/0/'+position,{},function(data){
					$('#resumen').load('/makePc/resume');
			});	
		}else{
			BJS.get('/makePc/myPCAddItem/'+rel+'/'+val+"/"+position,{},function(data){
				$('#resumen').load('/makePc/resume');
			});	
		}
		if(($item.parent().parent().is('.exclusivo'))){
			sibling = $item.parent().siblings().find('input[rel!="'+position+'"]');
			 sibling.removeAttr('checked'); 
		}
		switch(rel){
			case "Processor":
				pc.processor_id=val;
				getMotherBoard(val);
			break;
			case "Motherboard":
				
				pc.board_id=val;
				boardCallBack(val);
			break;
			case "VideoCard":
			pc.video_card_id = val;
			getCases(val);
			break;
		}
	});
	$(document).on('click','.checkbox input',function(){
		removeChecked=false;
		$item = $(this);
		var checked =$ (this).is(":checked");
		position=$item.val();
		if(checked){
			val=position;
		}else{
			val=0;
		}
				
		rel=$item.parent().parent().parent().attr('rel');
		BJS.get('/makePc/myPCAddItem/'+rel+'/'+val+"/"+position,{},function(data){
			$('#resumen').load('/makePc/resume');
		});	

		switch(rel){
			case "Processor":
				pc.processor_id=val;
				getMotherBoard(val);
			break;
			case "Motherboard":
				
				pc.board_id=val;
				boardCallBack(val);
			break;
			case "VideoCard":
			pc.video_card_id = val;
			getCases(val);
			break;
		}
	});
	
// FUNCIONES BASE	
	function getProcessors($architectureId){
		$('.radios.processors').load('/makePc/getProcessors/'+$architectureId,function(){
			processor_id=$('.radios.processors :checked').val();
			if(processor_id){ 
				pc.processor_id=processor_id;
				getMotherBoard(processor_id);
			}else{
				$('.radios.board-cards').html('<span class="no-items">No hay tarjetas disponibles</span>');
			}	
		});
	}
	function getMotherBoard($processorId){
		$('.radios.board-cards').load('/makePc/getMotherBoards/'+$processorId,function(){
			var board=$('.radios.board-cards :checked');
			var boardId = board.length > 0 ? board.val() : 0;
			if(boardId){
				pc.board_id=boardId;
			}
			boardCallBack(boardId)
		});
	}
	function boardCallBack(boardId){
		if(boardId) getRamCards(boardId);
		if(boardId) getHardDrives(boardId );
		if(boardId) getVideoCards(boardId);
		if(boardId) getOpticalDrives(boardId);
		if(boardId) pc.getOptionals(); 
	}
	function getRamCards(boardId){
		$('.radios.ram-cards').load('/makePc/getMemories/'+boardId, function(){//traer torres compatibles
			// lo que dependa de la memoria ram
		});
	}
	function getHardDrives(boardId){
		$('.radios.hard-drives').load('/makePc/getHardDrives/'+boardId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	function getVideoCards(boardId){
		$('.radios.video-cards').load('/makePc/getVideoCards/'+boardId, function(){//traer torres compatibles
			// lo que dependa de video cards
			var videoSelectedCardId = $('.radios.video-cards :checked');
			var videoId = videoSelectedCardId.length > 0 ? videoSelectedCardId.val() : 0;
			if(videoId){
				pc.video_card_id=videoId;
			}
			getCases(videoId);
			
		});
	}
	function videoCardCallback(videoSelectedCardId){
		var caseSelectedId = ($('.radios.cases :checked').length) > 0 ? $('.radios.video-cards :checked').val() : 0 ;
		getCases(videoSelectedCardId,caseSelectedId);
	}
	
	function getCases($videoCardId){
		if(!$videoCardId){
			$videoCardId=0;
		}
		$('.radios.cases').load('/makePc/getCasings/'+$videoCardId,function(){
			getSupply($videoCardId,$('.radios.cases :checked').val());
		});
	}
	function getSupply($videoCardId, $caseId ){
		if(!$videoCardId){
			$videoCardId=0;
		}
		if(!$caseId){
			$caseId=0;
		}
		$('.radios.supplies').load('/makePc/getPowerSupplies/'+$videoCardId+'/'+$caseId,function(){
			//lo que dependa de la fuente
		});
	}
	function getOpticalDrives(boardId){
		$('.radios.optical-drives').load('/makePc/getOpticalDrives/'+boardId, function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	
	function getMonitors(){
		$('.radios.monitors').load('/makePc/getMonitors', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		})
	}
	
	function getKeyBoards(){
		$('.radios.key-boards').load('/makePc/getKeyboards', function(){//traer teclados c
			//lo que dependa de hardDrives
		})	
	}
	function getMice(){
		$('.radios.mice').load('/makePc/getMice', function(){//traer mouse
			//lo que dependa de hardDrives
		})	
	}
	function getOtherCards(){
		$('.checkbox.other-cards').load('/makePc/getOtherCards/', function(){//traer torres compatibles
			//lo que dependa de hardDrives
		});
	}
	 pc.getOptionals = function(){
		getMonitors();
		getKeyBoards();
		getOtherCards();
		getMice();
	}
});