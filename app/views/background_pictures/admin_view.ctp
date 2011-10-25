<?php echo $this->Html->css('pictures'); ?>
<?php echo $this->Html->script('sortable');?><div class="gallery_view">
	<div class="pictures">
	<h2><?php if(isset($parentName)) echo $this->Html->link($parentName,array('controller'=>'backgrounds','action'=>'view', $parent_id)) ?> </h2>
		<ul id='sortable' controller="backgroundPictures">
		<?php foreach ($backgroundPictures as $backgroundPicture): ?>
			<li class='image-container ui-state-default'  id="<?php echo $backgroundPicture['BackgroundPicture']['id'];?>">
				<div class="image">
					<?php echo  $html->image('uploads/'. $backgroundPicture['BackgroundPicture']['path']); ?>
				</div>
				<div class='actions'>
					<?php echo  $this->Html->link(__('Delete', true), array('action' => 'delete',  $backgroundPicture['BackgroundPicture']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $backgroundPicture['BackgroundPicture']['id'])); ?> 
				</div>
			</li>
		<?php endforeach; ?> 
		</ul>
	</div>
	<div class="uploader-container">
		<input id="pictures-uploader" controller="backgroundPictures" rel="<?php echo $parent_id; ?>">
	</div>
</div>

