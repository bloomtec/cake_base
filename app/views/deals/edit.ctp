	
<div class="deals form2">
<?php echo $this->Form->create('Deal');?>
	<fieldset>
		<legend><?php __('Edit Deal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('restaurant_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('amount');
		echo $this->Form->input('price');
		echo $this->Form->input('max_buys');
		echo $this->Form->input('visits');
		echo $this->Form->input('Cuisine');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['Deal']['updated']);?>			</div>
		</div>
		<div id="single-upload" controller="deals">
		</div>			
</div>

