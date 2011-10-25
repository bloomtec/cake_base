<div class="gallery_view">
	<div class="fotos">
	<h1>PAPA </h1>
	<?php foreach ($galleryPictures as $galleryPicture): ?>
		<div class='image-container'>;
			<div class="image">
				<?php echo  $html->image('uploads/'. $galleryPicture['path']); ?>
			</div>
			<div class='actions'>
				<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $galleryPicture['GalleryPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $galleryPicture['GalleryPicture']['id'])); ?> 
			</div>
		</div>
	<?php endforeach; ?> 
	</div>
	<div class="images">
		<input id="multiple-upload" controller="galleryPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>