<?php echo $this->Html->css('pictures'); ?>
<?php echo $this->Html->script('sortable');?><div class="gallery_view">
	<div class="pictures">
	<h2><?php if(isset($parentName)) echo $this->Html->link($parentName,array('controller'=>'galleries','action'=>'view', $parent_id)) ?> </h2>
		<ul id='sortable' controller="galleryPictures">
		<?php foreach ($galleryPictures as $galleryPicture): ?>
			<li class='image-container ui-state-default'  id="<?php echo $galleryPicture['GalleryPicture']['id'];?>">
				<div class="image">
					<?php echo  $html->image('uploads/'. $galleryPicture['GalleryPicture']['path']); ?>
				</div>
				<div class='actions'>
					<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $galleryPicture['GalleryPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $galleryPicture['GalleryPicture']['id'])); ?> 
				</div>
			</li>
		<?php endforeach; ?> 
		</ul>
	</div>
	<div class="uploader-container">
		<input id="pictures-uploader" controller="galleryPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>

