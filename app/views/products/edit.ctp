	
<div class="products form2">
<?php echo $this->Form->create('Product');?>
	<fieldset>
		<legend><?php __('Edit Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('ref');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['Product']['image']);?>			</div>
		</div>
		<div id="single-upload" controller="products">
		</div>			
</div>

