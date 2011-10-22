	
<div class="products form2">
<?php echo $this->Form->create('Product');?>
	<fieldset>
		<legend><?php __('Add Product'); ?></legend>
	<?php
		echo $this->Form->input('product_type_id');
		echo $this->Form->input('architecture_id');
		echo $this->Form->input('socket_id');
		echo $this->Form->input('slot_id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('ref');
		echo $this->Form->input('price');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('slug');
		echo $this->Form->input('keywords');
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
		<div id="single-upload" controller="products">
		</div>			
</div>

