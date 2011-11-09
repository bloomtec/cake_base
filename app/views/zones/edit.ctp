	
<div class="zones form2">
<?php echo $this->Form->create('Zone');?>
	<fieldset>
		<legend><?php __('Edit Zone'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('city_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('lat');
		echo $this->Form->input('long');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['Zone']['updated']);?>			</div>
		</div>
		<div id="single-upload" controller="zones">
		</div>			
</div>

