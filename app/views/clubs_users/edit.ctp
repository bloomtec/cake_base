<div class="clubsUsers form">
<?php echo $this->Form->create('ClubsUser');?>
	<fieldset>
		<legend><?php __('Edit Clubs User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('club_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

