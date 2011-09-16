<div class="matchStatuses form">
<?php echo $this->Form->create('MatchStatus');?>
	<fieldset>
		<legend><?php __('Admin Edit Match Status'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

