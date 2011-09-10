<div class="countrySquadsUsers form">
<?php echo $this->Form->create('CountrySquadsUser');?>
	<fieldset>
		<legend><?php __('Admin Edit Country Squads User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('country_squad_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

