<div class="galleries view">
	<h2><?php  __('Gallery');?></h2>
	<dl>
		<?php $i = 0;
		$class = ' class="altrow"';
		?>
		<dt<?php
		if ($i % 2 == 0)
			echo $class;
		?>>
			<?php __('Name');?></dt>
			<dd<?php
			if ($i++ % 2 == 0)
				echo $class;
			?>>
				<?php echo $gallery['Gallery']['name'];?>
				&nbsp;
				</dd>
				<dt<?php
				if ($i % 2 == 0)
					echo $class;
				?>>
					<?php __('Description');?></dt>
					<dd<?php
					if ($i++ % 2 == 0)
						echo $class;
					?>>
						<?php echo $gallery['Gallery']['description'];?>
						&nbsp;
						</dd>
						<dt<?php
						if ($i % 2 == 0)
							echo $class;
						?>>
							<?php __('Created');?></dt>
							<dd<?php
							if ($i++ % 2 == 0)
								echo $class;
							?>>
								<?php echo $gallery['Gallery']['created'];?>
								&nbsp;
								</dd>
								<dt<?php
								if ($i % 2 == 0)
									echo $class;
								?>>
									<?php __('Updated');?></dt>
									<dd<?php
									if ($i++ % 2 == 0)
										echo $class;
									?>>
										<?php echo $gallery['Gallery']['updated'];?>
										&nbsp;
										</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Related Pictures');?></h3>
	<div class="images">
		<input id="multiple-upload" controller="images" rel="<?=$gallery["Gallery"]["id"]?>" >
	</div>
	<?php if (!empty($gallery['Picture'] )):
	?>
	<div class="pictures">
		<?php
$i = 0;
foreach ($gallery['Picture'] as $image):
$class = "class='image-container'";
		?>
		<div <?php echo $class;?>>
			<div class="image">
				<?php echo $html -> image("/img/uploads/200x200/" . $image['image']);?>
			</div>
			<div class="actions">
				<?php echo $this -> Html -> link(__('Delete', true), array('controller' => 'pictures', 'action' => 'delete', $image['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $image['id']));?>
			</div>
		</div>
		<?php endforeach;?>
	</div>
	<?php endif;?>
</div>
