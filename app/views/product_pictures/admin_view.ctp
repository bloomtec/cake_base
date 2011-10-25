<?php echo $this->Html->css('pictures'); ?>
<div class="gallery_view">
	<div class="pictures">
	<h2><?php if(isset($parentName)) echo $this->Html->link($parentName,array('controller'=>'products','action'=>'view', $parent_id)) ?> </h2>
		<ul id='sortable' controller="productPictures">
		<?php foreach ($productPictures as $productPicture): ?>
			<li class='image-container ui-state-default'  id="<?php echo $productPicture['ProductPicture']['id'];?>">
				<div class="image">
					<?php echo  $html->image('uploads/'. $productPicture['ProductPicture']['path']); ?>
				</div>
				<div class='actions'>
					<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $productPicture['ProductPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productPicture['ProductPicture']['id'])); ?> 
				</div>
			</li>
		<?php endforeach; ?> 
		</ul>
	</div>
	<div class="uploader-container">
		<input id="pictures-uploader" controller="productPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>

