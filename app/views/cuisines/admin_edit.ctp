	
<div class="cuisines form2">
<?php echo $this->Form->create('Cuisine');?>
	<fieldset>
		<legend><?php __('Admin Edit Cuisine'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		//echo $this->Form->input('Deal');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper">
			<?php
			 	if(!empty($this -> data['Cuisine']['image'])) {
			 		echo $this->Html->image('/img/uploads/'.$this -> data['Cuisine']['image']);
			 	} else {
			 		echo $this->Html->image('preview.png');
			 	}					 	
			 ?>
		</div>
	</div>
	<div id="single-upload" controller="cuisines">
	</div>			
</div>

