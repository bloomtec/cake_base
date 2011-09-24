<div class="pages form">
<?php echo $this->Form->create('Page');?>
	<fieldset>
		<legend><?php __('Add Gallery Page To Menu :: ' . $menu_title); ?></legend>
	<?php
		echo $this->Form->hidden('menu_id', array('value' => $menu_id));
		echo $this->Form->hidden('page_type_id', array('value' => 2));
		echo $this->Form->input('title', array('value' => $menu_title));
		echo $this->Form->hidden('wysiwg_content');
		echo $this->Form->hidden('pic_1');
		echo $this->Form->hidden('pic_2');
		echo $this->Form->hidden('pic_3');
		echo $this->Form->hidden('pic_4');
	?>
	
		<div class="uploaderPics pic1">
			<div class="preview">
				
			</div>
			<h3>Pic 1</h3>
			<div id="uploadfy1"></div>
		</div>
		<div class="uploaderPics pic2">
			<div class="preview">
				
			</div>
			<h3>Pic 2</h3>
			<div id="uploadfy2"></div>
		</div>
		<div class="uploaderPics pic3">
			<div class="preview">
				
			</div>
			<h3>Pic 3</h3>
			<div id="uploadfy3"></div>
		</div>
		<div class="uploaderPics pic4">
			<div class="preview">
				
			</div>
			<h3>Pic 4</h3>
			<div id="uploadfy4"></div>
		</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

