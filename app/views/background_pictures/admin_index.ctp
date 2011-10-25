<div class="gallery_view">
	<div class="fotos">
	<h1>PAPA </h1>
	<?php foreach ($backgroundPictures as $backgroundPicture): ?>
		<div class='image-container'>;
			<div class="image">
				<?php echo  $html->image('uploads/'. $backgroundPicture['path']); ?>
			</div>
			<div class='actions'>
				<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $backgroundPicture['BackgroundPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $backgroundPicture['BackgroundPicture']['id'])); ?> 
			</div>
		</div>
	<?php endforeach; ?> 
	</div>
	<div class="images">
		<input id="multiple-upload" controller="backgroundPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>