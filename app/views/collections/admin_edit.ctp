<div class="collections form">
	<?php echo $this -> Form -> create('Collection');?>
	<fieldset>
		<legend>
			<?php __('Admin Edit Collection');?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name');
		?>
		<div style="clear: both;">
			<div style="clear: none; float: right;">
				<?php
				echo $this -> Form -> input('brand_id');
				?>
			</div>
			<div style="clear: none; float: left;;">
				<?php
				echo $this -> Form -> input('category', array('disabled' => true));
				?>
			</div>
		</div>
	</fieldset>
	<?php echo $this -> Form -> end(__('Submit', true));?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var brand_id = document.getElementById('CollectionBrandId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('CollectionCategory').value = myObject.Category.name; 
				} else {
					alert("Error");
				}
			}
		});
	});
	$('#CollectionBrandId').change(function() {
		var brand_id = document.getElementById('CollectionBrandId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('CollectionCategory').value = myObject.Category.name; 
				} else {
					alert("Error");
				}
			}
		});
	});

</script>