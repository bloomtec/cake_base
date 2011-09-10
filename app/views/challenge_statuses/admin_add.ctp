<div class="challengeStatuses form">
<?php echo $this->Form->create('ChallengeStatus');?>
	<fieldset>
		<legend><?php __('Admin Add Challenge Status'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

