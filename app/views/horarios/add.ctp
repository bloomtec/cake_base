	
<div class="horarios form2">
<?php echo $this->Form->create('Horario');?>
	<fieldset>
		<legend><?php __('Add Horario'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('color_code');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('is_active');
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
		<div id="single-upload" controller="horarios">
		</div>			
</div>

