<?php echo $this -> element('order/index'); ?>
<?php $lastOrder=isset($orders[0])? $orders[0]['Order']['id']:0; $lastOrder=12;?>
<script type="text/javascript">
 	var lastOrder="<?php echo $lastOrder; ?>";
	$(function(){
		setInterval(function(){
			BJS.JSON('/orders/orderStatus/'+lastOrder,{},function(event){
				if(event){
					switch(event.event){
						case "newOrder":
						console.log(event.value);
						break;
						
					}
				}else{
					//NO HAY EVENTO
				}
			});
		},5000);
	});
</script>