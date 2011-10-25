	
<div class="backgroundPictures form2">
<?php echo $this->Form->create('BackgroundPicture');?>
	<fieldset>
		<legend><?php __('Edit Background Picture'); ?></legend>
	<?php
		echo $this->Form->input('id');
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
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['BackgroundPicture']['background_id']);?>			</div>
		</div>
		<div id="single-upload" controller="backgroundPictures">
		</div>			
</div>

