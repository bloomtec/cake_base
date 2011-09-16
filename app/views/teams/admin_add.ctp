	
<div class="teams form2">
<?php echo $this->Form->create('Team');?>
	<fieldset>
		<legend><?php __('Admin Add Team'); ?></legend>
	<?php
		echo $this->Form->input('team_style_id');
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
		<div id="single-upload" controller="teams">
		</div>			
</div>

