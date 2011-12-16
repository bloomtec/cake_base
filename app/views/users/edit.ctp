<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('phone');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>

<h2> <?php __('Address') ?></h2>

<?php foreach($this->data['Address'] as $address): ?>
<?php echo $this->Form->create('Address');?>
	<fieldset>
	<?php
		echo $this -> Form -> hidden('Address.id', array('value' => $address['id']));
		echo $this -> Form -> hidden('Address.user_id', array('value' => $address['user_id']));
		echo $this -> Form -> input('Address.name', array('required' => 'required', 'value' => $address['name']));
		echo $this -> Form -> input('Address.country_id', array('required' => 'required','options' => $countries, 'selected' => $address['country_id']));
		echo $this -> Form -> input('Address.city_id', array('required' => 'required','options' => $cities, 'selected' => $address['city_id']));
		echo $this -> Form -> input('Address.address', array('required' => 'required', 'value' => $address['address']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
<?php endforeach; ?>

<h2><?php __('Add Address')?></h2>
<?php echo $this->Form->create('Address',array('action' => 'add'));?>
	<fieldset>
	<?php
		echo $this -> Form -> hidden('Address.user_id', array('value' => $this->params['pass'][0]));
		echo $this -> Form -> input('Address.name', array('required' => 'required'));
		echo $this -> Form -> input('Address.country_id', array('required' => 'required','options' => $countries));
		echo $this -> Form -> input('Address.city_id', array('required' => 'required','options' => $cities));
		echo $this -> Form -> input('Address.address', array('required' => 'required'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>