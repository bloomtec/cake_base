<?php
echo $this->Form->create();
echo $this->Form->input('q', array('label'=>'Search terms:'));
echo $this->Form->end('Search');
if (!empty($videos)) {
?>
<h1>Search results</h1>
<?php foreach($videos as $video) {
?>
<div style="float: left; clear: both; margin-bottom: 10px;">
	<h4><?php echo $this -> Html -> link($video['Video']['title'], $video['Video']['url']);?></h4>
	<?php echo $this -> Html -> image($video['Video']['thumbnail'], array('url' => $video['Video']['url'], 'align' => 'left', 'style' => 'margin-right: 10px;'));?>
	<p>
		<?php echo $video['Video']['description'];?>
	</p>
	<br />
	<p>
		<small> Uploaded on <?php echo date('F d, Y H:i', $video['Video']['uploaded']);?>in <?php echo $video['Video']['category'];?>- <strong><?php echo $this -> Html -> link('PLAY', $video['Video']['url']);?></strong> </small>
	</p>
</div>
<?php
}
}
?>
