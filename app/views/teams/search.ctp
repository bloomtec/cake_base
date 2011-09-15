<div class="search form">
	<?php echo $this->Form->create('Team', array('action' => 'search'));?>
		<fieldset>
			<legend><?php __('Search'); ?></legend>
			<?php
				echo $this->Form->input('criteria', array('label' => 'NOMBRE'));
			?>
		</fieldset>
	<?php echo $this->Form->end(__('flecha a la derecha', true));?>
	<div class="equipos">
		<?php foreach($results as $team):?>
			<div class="team">
				<?php echo $html->image($team["Team"][0]["image"],array("width"=>120));?>
			</div>
		<?php endforeach;?>
	</div>
	<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
		 | 	<?php echo $this->Paginator->numbers();?>
	 |
			<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>