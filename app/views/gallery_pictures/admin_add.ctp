<div class="galleryPictures form">
<?php echo $this->Form->create('GalleryPicture');?>
	<fieldset>
		<legend><?php __('Admin Add Gallery Picture'); ?></legend>
	<?php
		echo $this->Form->input('gallery_id');
		echo $this->Form->input('path');
		echo $this->Form->input('alt');
		echo $this->Form->input('sort');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

