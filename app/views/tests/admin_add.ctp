	
<div class="tests form2">
<?php echo $this->Form->create('Test');?>
	<fieldset>
		<legend><?php __('Admin Add Test'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('image_path',array('id' => 'single-field'));
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
		<div id="single-upload" controller="tests">
		</div>			
</div>

