<style>
	.start{
		width:17px;
		height:17px;
		cursor:pointer;
		float:left;
	}
	.start-0{
		background: url(/img/estrella_inact.png);
		
	}
	.start-1{
		background: url(/img/estrella_mid.png);
		
	}
	.start-2{
		background: url(/img/estrella_mid.png);
		
	}
	.start-3{
		background: url(/img/estrella_mid.png);
		
	}
	.start-4{
		background: url(/img/estrella_mid.png);
		
	}
	.start-5{
		background: url(/img/estrella_act.png);
		
	}
	
</style>
<div class='start start-0' rel='0'> </div>
<div class='start start-0' rel='1'> </div>
<div class='start start-0' rel='2'> </div>
<div class='start start-0' rel='3'> </div>
<div class='start start-0' rel='4'> </div>

<script>
	$(function(){
		var estrellas= {
				'0':{'element':$('div.start[rel="0"]'),'first-class':$('div.start[rel="0"]').attr('class'),'actual-class':$('div.start[rel="0"]').attr('class')},
				'1':{'element':$('div.start[rel="1"]'),'first-class':$('div.start[rel="1"]').attr('class'),'actual-class':$('div.start[rel="1"]').attr('class')},
				'2':{'element':$('div.start[rel="2"]'),'first-class':$('div.start[rel="2"]').attr('class'),'actual-class':$('div.start[rel="2"]').attr('class')},
				'3':{'element':$('div.start[rel="3"]'),'first-class':$('div.start[rel="3"]').attr('class'),'actual-class':$('div.start[rel="3"]').attr('class')},
				'4':{'element':$('div.start[rel="4"]'),'first-class':$('div.start[rel="4"]').attr('class'),'actual-class':$('div.start[rel="4"]').attr('class')}
			 }
		$('.start').mouseenter(function(){
			var $that=$(this);
			var thatRel=$that.attr('rel');
			$.each(estrellas,function(i,val){
				if(thatRel >= val['element'].attr('rel')){
					val['element'].removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
					val['actual-class'] = 'start-5';
				}
			})
			/* $(this).removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			$(this).prevAll().removeClass('start-0 start-1 start-2 start-3 start-4').addClass('start-5');
			estrellas[$(this).attr('rel')]['actual-class']='start-5'; */
		});
	})
</script>