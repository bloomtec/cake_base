<?php $categories=$this->requestAction("/categories/getList");?>
<div id="header">
	<h1>
	<a  href="/">Color Tennis</a>
	</h1>
	<ul class="tahoma">
		<li>
			<a rel="#overlay" href="/users/login">Login</a>
		</li>
		<li>
			/
		</li>
		<li>
			<a rel="#overlay" href="/users/login">Regístrate</a>
		</li>
	</ul>
	<ul class="main_nav twCenMt">
		<li class="home halo <?php if(!isset($category)) echo 'current'?>">
			<a href="/">Home</a>
		</li>
		<?php foreach($categories as $id=>$name):?>
		<li class="categoria <?php if(isset($category)&&$category['Category']['id']==$id) echo 'current'?>">
			<a href="/categories/view/<?php echo $id?>"><?php echo $name?></a>
		</li>
		<?php endforeach;?>
	</ul>
	
</div>
