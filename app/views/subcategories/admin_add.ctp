<div class="subcategories form2">
	<?php echo $this -> Form -> create('Subcategory');?>
	<fieldset>
		<legend>
			<?php __('Admin Add Subcategory');?>
		</legend>
		<?php
		echo $this -> Form -> input('name');
		echo $this -> Form -> input('sizes', array('multiple'=>'checkbox'));
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> hidden('sort');
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
<div class="images">
	<h2>Image</h2>
	<div class="preview">
		<div class="wrapper">
			<?php echo $this -> Html -> image('preview.png');?>
		</div>
	</div>
	<div id="single-upload" controller="subcategories"></div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var brand_id = document.getElementById('SubcategoryBrandId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('SubcategoryCategory').value = myObject.Category.name;
				} else {
					alert("Error");
				}
			}
		});
	});
	$('#SubcategoryBrandId').change(function() {
		var brand_id = document.getElementById('SubcategoryBrandId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('SubcategoryCategory').value = myObject.Category.name;
				} else {
					alert("Error");
				}
			}
		});
	});

</script>