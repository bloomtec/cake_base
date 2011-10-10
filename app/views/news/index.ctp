<div class='home-container'>
<?php 
	$news=$this->requestAction('/news/getNews');
	$almenosUnAd=false;
	$iNews=0;
?>
<?php foreach($news as $new):?>
	<div class='new'>
		<div class='image'>
			<?php echo $html->link($html->image('uploads/'.$new['News']['image'],array('width'=>147.5,'height'=>44)),array('controller'=>'news','action'=>'view',$new['News']['id']),array('target'=>'_blank','escape'=>false));?>
		</div>
		<div class='description'>
			<h1><?php echo $html->link($new['News']['name'],array('controller'=>'news','action'=>'view',$new['News']['id']),array('target'=>'_blank'));?></h1>
			<p><?php echo $new['News']['description'];?></p>
		</div>
		<div style='clear:both;'></div>
	</div>
	<?php 
		/*if($iNews++==2){
			$almenosUnAd=true;
			 echo $ads[0]['Ad']['wysiwyg_content']; 
		}*/
	?>
<?php endforeach;?>
<?php //if(!$almenosUnAd) echo "<a href='".$ads[0]['Ad']['link']."' target='_blank'>".$ads[0]['Ad']['wysiwyg_content']."</a>" ?>
</div>