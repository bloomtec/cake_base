<div class="orders form">
<?php echo $this->Form->create('Config',array("url"=>"/admin/config/edit"));?>
	<fieldset>
		<legend><?php __('Admin Edit Configuration'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('score_by_registering');
		echo $this->Form->input('score_by_invitations');
		echo $this->Form->input('max_score_by_invitations');
		echo $this->Form->input('score_for_buying');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

