<div class="countrySquadsUsers form">
<?php echo $this->Form->create('CountrySquadsUser');?>
	<fieldset>
		<legend><?php __('Add Country Squads User'); ?></legend>
	<?php
		echo $this->Form->input('country_squad_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

