<style>
	.overlay-wrap{
		width:960px;
		height: 571px;
	}
	.overlay-wrap .header {
		padding-left: 300px;
		background-color:#cbcbcb;
		background-image: url(../img/logo_header.png);
		background-position: left center;
		background-repeat: no-repeat;
		height: 105px;
		border-bottom: solid 1px #494949;
	}
	.overlay-wrap .header h2{
		font-size: 22px;
		color:#ec1c75;
		text-transform: uppercase;
		background-color:#dddddd;
		height: 25px;
		margin-top: 20px;
		display: block;
		float: right;
		margin-right: 20px;
		padding: 20px;
		border: solid 1px white;
	}
	.overlay-wrap .content{
		background-image: url(../img/trama-overlay.png);
		height: 426px;
		padding: 20px;
	}
</style>
<div class='overlay-wrap'>
	<div class="header">
		<h2><?php echo $titulo;?></h2>
	</div>
	<div class="content">
		<?php echo $content_for_layout;?>
	</div>
</div>