<ul class="nomina listado">
		<?php foreach($payroll as $user):?>
			<li class="player">
				<div class="actions">
					<?php echo $html->link($html->image("boton-add.png"),array("controller"=>"users","action"=>"addToFriends"),array("escape"=>false,"title"=>"A�adir"))?>
				</div>
				<div class="image">
				<?php echo $html->link($html->image($user["UserField"][0]["image"]),array("controller"=>"users","action"=>"profile",$user["User"]["id"]),array("escape"=>false,"class"=>"overlay"));?>
				</div>
				<div class="name">
					<?php echo $user["UserField"][0]["name"]; ?>
				</div>	
			</li>
		<?php endforeach;?>		
		<div style="clear:both;"></div>
</ul>
<div class="paging paging-list">		
<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	| 	<?php echo $this->Paginator->numbers();?>
	|	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>