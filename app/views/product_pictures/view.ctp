<?php echo $this->Html->css('pictures'); ?>
<div class="gallery_view">
	<div class="pictures">
	<h1><?php if(isset($parentName)) echo $parentName ?> </h1>
	<?php foreach ($productPictures as $productPicture): ?>
		<div class='image-container'>
			<div class="image">
				<?php echo  $html->image('uploads/'. $productPicture['ProductPicture']['path']); ?>
			</div>
			<div class='actions'>
				<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $productPicture['ProductPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productPicture['ProductPicture']['id'])); ?> 
			</div>
		</div>
	<?php endforeach; ?> 
	</div>
	<div class="uploader-container">
		<input id="pictures-uploader" controller="productPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>