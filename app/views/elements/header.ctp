<?php $categories=$this->requestAction("/categories/getList");?>
<div id="header">
	<h1>
	<a  href="/">Color Tennis</a>
	</h1>
	<ul>
		<li>
			<a href="/users/login">Login</a>
		</li>
		<li>
			/
		</li>
		<li>
			<a href="#">Regístrate</a>
		</li>
	</ul>
	<ul class="main_nav">
		<li class="home halo">
			<a href="#">Home</a>
		</li>
		<?php foreach($categories as $id=>$name):?>
		<li class="categoria">
			<a href="/categories/view/<?php echo $id?>"><?php echo $name?></a>
		</li>
		<?php endforeach;?>
	</ul>
</div>