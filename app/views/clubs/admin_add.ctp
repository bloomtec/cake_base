	
<div class="clubs form2">
<?php echo $this->Form->create('Club');?>
	<fieldset>
		<legend><?php __('Admin Add Club'); ?></legend>
	<?php
		echo $this->Form->input('league_id');
		echo $this->Form->input('name');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('User');
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
		<div id="single-upload" controller="clubs">
		</div>			
</div>

