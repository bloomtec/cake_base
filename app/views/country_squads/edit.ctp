	
<div class="countrySquads form2">
<?php echo $this->Form->create('CountrySquad');?>
	<fieldset>
		<legend><?php __('Edit Country Squad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['CountrySquad']['image']);?>			</div>
		</div>
		<div id="single-upload" controller="countrySquads">
		</div>			
</div>
