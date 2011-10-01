<div class="products form2">
	<?php echo $this -> Form -> create('Product');?>
	<fieldset>
		<legend>
			<?php __('Admin Add Product');?>
		</legend>
		<?php
		echo $this -> Form -> input('name');
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> input('clasification');
		echo $this -> Form -> input('subcategory_id');
		echo $this -> Form -> input('collection_id', array('empty'=>true));
		echo $this -> Form -> input('category', array('disabled' => true));
		?>
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
	<div id="single-upload" controller="products"></div>
</div>
<script type="text/javascript">
	$('#ProductSubcategoryId').change(function() {
		var sub_category_id = document.getElementById('ProductSubcategoryId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + sub_category_id,
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