	
<div class="pictures form2">
<?php echo $this->Form->create('Picture');?>
	<fieldset>
		<legend><?php __('Edit Picture'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('product_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['Picture']['updated']);?>			</div>
		</div>
		<div id="single-upload" controller="pictures">
		</div>			
</div>

