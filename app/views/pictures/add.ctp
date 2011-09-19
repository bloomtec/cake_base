	
<div class="pictures form2">
<?php echo $this->Form->create('Picture');?>
	<fieldset>
		<legend><?php __('Add Picture'); ?></legend>
	<?php
		echo $this->Form->input('gallery_id');
		echo $this->Form->input('title');
		echo $this->Form->input('caption');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('alt');
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
		<div id="single-upload" controller="pictures">
		</div>			
</div>

