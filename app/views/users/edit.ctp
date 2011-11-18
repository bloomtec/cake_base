	
<div class="users form2">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Completar o modificar mis datos'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('role_id',array('value'=>2));
		echo $this->Form->input('email');
		echo $this->Form->hidden('image',array('id' => 'single-field'));
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('gender');
		echo $this->Form->input('phone');
		echo $this->Form->input('country');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('address');
	?>
	<?php echo $this->Form->end(__('Send', true));?>
	</fieldset>

</div>
<!--
<div class="images">
		<h2>Image</h2>
		<div class="preview">
			<div class="wrapper">
					<?php echo $this->Html->image('uploads/400x400/'.$this->data['User']['updated']);?>			</div>
		</div>
		<div id="single-upload" controller="users">
		</div>			
</div>
-->
<div style='clear:both'></div>
