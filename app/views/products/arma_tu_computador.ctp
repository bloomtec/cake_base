<!-- the form -->
<div class='pc-error' style='display:none; position:fixed; top:0; height:100px; background: orange; color: white; width:100%; left:0;'></div>
<?php $form->create('PC',array('action'=>'armaTuPC'));?>

	
	<div class="panes">
		<div>
			<h1>Procesador</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
			</p>
			<div class="seleccionar">
				<label>Elije la marca de tu procesador</label>
				<?php echo $form->input('architecture_id',array('id'=>'architecture','options'=>$arquitectures,'label'=>'Arquitectura'));?>
			</div>
			<a href="#" class="siguiente_paso">Siguiente paso</a>
			<div style="clear: both;margin-bottom: 10px"></div>
			<h2>Seleccione su procesador</h2>
			<div class='radios processors'>
				<!--Espacio donde se  llenan los radios de los procesadores-->	
			</div>
			<h2>Seleccione su tarjeta madre</h2>
			<div class='radios boards'>
				<!-- Espacio donde se llenan los radios de las boards-->
			</div>
		</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
		<div>Third tab content</div>
		<div>First tab content. Tab contents are called "panes"</div>
		<div>Second tab content</div>
	</div>
	<div class="resumen">
		<h1>Resumen de la compra</h1>
		<div class="precio">
			<img src="/img/computador.jpg"/>
			<h2>Precio total:1.500.000</h2>
		</div>
		<div class="resumen_menu">
			<ul>
				<li><a href="">Ir a mi carrito</a></li>
				<li><a href="">Pagar</a></li>
				<li><a href="">Imprimir</a></li>
			</ul>
		</div>
		<div class="resumen_productos">
			<a href="/"><h1>Procesador</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjeta madre</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjeta de video</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Memoria RAM</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Discos duros</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Monitor</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Torre</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Fuente</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Unidades óptcas</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Periféricos</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Tarjetas adicionales</h1></a>
			<a href="/"><h2>algo</h2></a>
			<a href="/"><h1>Accesorios</h1></a>
			<a href="/"><h2>algo</h2></a>
		</div>
		
	</div>
		<a class="prev browse left"></a>
		<div class="scrollable">   
			<ul class='tabs items'>
				<li><a href="#" id='processor'><div class="img_wrapper"><img src="/img/procesador.png" /></div>Procesador y tarjeta madre</a></li>
				<li><a href="#" id='tarjeta-video'><div class="img_wrapper"><img src="/img/tarjeta_video.png" /></div>Tarjeta de video</a></li>
				<li><a href="#" id='tarjeta-ram'><div class="img_wrapper"><img src="/img/ram.png" /></div>Memoria Ram</a></li>
				<li><a href="#" id='discco-duro'><div class="img_wrapper"><img src="/img/disco_duro.png" /></div>Discos duros</a></li>
				<li><a href="#" id='monitor'><div class="img_wrapper"><img src="/img/monitor.png" /></div>Monitor</a></li>
				<li><a href="#" id='torre'><div class="img_wrapper"><img src="/img/torre.png" /></div>Torre</a></li>
				<li><a href="#" id='fuente'><div class="img_wrapper"><img src="/img/fuente.png" /></div>Fuente</a></li>
				<li><a href="#" id='unidad-optica'><div class="img_wrapper"><img src="/img/cd.png" /></div>Unidades ópticas</a></li>
				<li><a href="#" id='mouse'><div class="img_wrapper"><img src="/img/mouse.png" /></div>Periféricos</a></li>
				<li><a href="#" id='tarjetas-adicionales'><div class="img_wrapper"><img src="/img/tarjeta_adicional.png" /></div>Tarjetas adicionles</a></li>
				<li><a href="#" id='accesorios'><div class="img_wrapper"><img src="/img/audifonos.png" /></div>Accesorios</a></li>
			</ul>
		</div>
		<a class="next browse right"></a>
		<div style="clear: both"></div>
</form>


<script type="text/javascript">
$(function() {
	var pc = {};
	$("input[name='data[processor_id]']").live('click',function(){
		
	});
	pc.processorFunctionality = function(currentTab){
		
	}
	pc.tarjetaVideoFunctionality = function(currentTab){
		var proccesorId = $(".processors input:checked").length > 0 ? $(".processors input:checked").attr('value') : 0;
		var boardId = $(".boards input:checked").length > 0 ? $(".processors input:checked").attr('value') : 0;
		if(proccesorId && boardId){//selecciono el procesador
			
		}else{// no selecciono el procesador
			$('.pc-error').html('Debes seleccionar un procesador y una tarjeta').show();
			return false;
		}	
	}
	pc.discoDuroFunctionality = function(currentTab){
	}
	pc.monitorFunctionality = function(currentTab){
	}
	pc.torreFunctionality = function(currentTab){
	}
	pc.fuenteFunctionality = function(currentTab){
	}
	pc.unidadOpticaFunctionality = function(currentTab){
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
			case 'tarjeta-video':
				return pc.tarjetaVideoFunctionality(currentTab);
			break;
			case 'discco-duro':
				return pc.discoDuroFunctionality(currentTab);
			break;
			case 'monitor':
				return pc.monitorFunctionality(currentTab);
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
	$(".scrollable").scrollable();
	var tabsApi = $("ul.tabs").data("tabs");
	//TAB 1 init
	$('#architecture').change(function(){
		$('.radios.processors').load('/products/getProcessors/'+$(this).val(),function(){
			$('.radios.boards').load('/products/getMotherBoards/'+$('.radios.processors').val());
		});
	});
	
	$('.radios.processors').load('/products/getProcessors/'+$('#architecture').val(),function(){
		var $proccessorId = $(this).find('input:checked');
		$('.radios.boards').load('/products/getMotherBoards/'+$proccessorId.val());
	});
	
	$('.radios.processors input').live('click',function(){
		var $proccessorId = $(this);
		$('.radios.boards').load('/products/getMotherBoards/'+$proccessorId.val());
	});
	$('.radios input').live('click',function(){
		$('.pc-error').html('').hide();
			
	});

});
</script>