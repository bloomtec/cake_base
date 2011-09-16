<div class="clubsUsers form">
<?php echo $this->Form->create('ClubsUser');?>
	<fieldset>
		<legend><?php __('Admin Add Clubs User'); ?></legend>
	<?php
		echo $this->Form->input('club_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

