	
<div class="cities form2">
<?php echo $this->Form->create('City');?>
	<fieldset>
		<legend><?php __('Admin Add City'); ?></legend>
	<?php
		echo $this->Form->input('country_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('is_present');
		echo $this->Form->input('code');
		//echo $this->Form->input('lat');
		//echo $this->Form->input('long');
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
		<div id="single-upload" controller="cities">
		</div>			
</div>

