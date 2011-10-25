	
<div class="backgroundPictures form2">
<?php echo $this->Form->create('BackgroundPicture');?>
	<fieldset>
		<legend><?php __('Add Background Picture'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('background_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					 <?php echo $this->Html->image('preview.png');?>
			</div>
		</div>
		<div id="single-upload" controller="backgroundPictures">
		</div>			
</div>

