	
<div class="countries form2">
<?php echo $this->Form->create('Country');?>
	<fieldset>
		<legend><?php __('Admin Edit Country'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('language');
		echo $this->Form->input('is_present');
		echo $this->Form->input('code');
		echo $this->Form->input('money_symbol');
		echo $this->Form->input('price_ranges');
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
		<div id="single-upload" controller="countries">
		</div>			
</div>

