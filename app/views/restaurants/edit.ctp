	
<div class="restaurants form2">
<?php echo $this->Form->create('Restaurant');?>
	<fieldset>
		<legend><?php __('Edit Restaurant'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('zone_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['Restaurant']['updated']);?>			</div>
		</div>
		<div id="single-upload" controller="restaurants">
		</div>			
</div>

