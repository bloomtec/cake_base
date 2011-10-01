<div class="products form2">
	<?php echo $this -> Form -> create('Product');?>
	<fieldset>
		<legend>
			<?php __('Admin Edit Product');?>
		</legend>
		<?php
		echo $this -> Form -> input('id');
		echo $this -> Form -> input('name');
		echo $this -> Form -> hidden('image', array('id' => 'single-field'));
		echo $this -> Form -> input('clasification');
		?>
		<div style="clear: both;">
			<div style="clear: none; float: right;">
				<?php
				echo $this -> Form -> input('brand_id');
				echo $this -> Form -> hidden('brand_id_value', array('value' => $this -> data['Subcategory']['brand_id']));
				?>
			</div>
			<div style="clear: none; float: left;;">
				<?php
				echo $this -> Form -> input('category', array('disabled' => true));
				?>
			</div>
		</div>
		<div style="clear: both;">
			<div style="clear: none; float: right;">
				<?php
				echo $this -> Form -> input('collection_id');
				?>
			</div>
			<div style="clear: none; float: left;;">
				<?php
				echo $this -> Form -> input('subcategory_id');
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
			<?php echo $this -> Html -> image("/img/uploads/200x200/" . $this -> data['Product']['image']);?>
		</div>
	</div>
	<div id="single-upload" controller="products"></div>
</div>
<script type="text/javascript">
	/**
	 * Ejecutar al cargar la página
	 */
	$(document).ready(function() {
		var brand_id = document.getElementById('ProductBrandIdValue').value;
		$('#ProductBrandId').val(brand_id);
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('ProductCategory').value = myObject.Category.name;
				} else {
					alert("Error");
				}
			}
		});
		jQuery.ajax({
			url : "/subcategories/listBrandCategories/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var categories = eval(data);
					$("select[id$=ProductSubcategoryId] > option").remove();
					$.each(categories, function(index, value) {
						$('#ProductSubcategoryId').append($('<option></option>').val(index).html(value));
					});
				} else {
					alert("Error");
				}
			}
		});
		jQuery.ajax({
			url : "/collections/listBrandCollections/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var categories = eval(data);
					$("select[id$=ProductCollectionId] > option").remove();
					$.each(categories, function(index, value) {
						$('#ProductCollectionId').append($('<option></option>').val(index).html(value));
					});
				} else {
					alert("Error");
				}
			}
		});
	});
	/**
	 * Ejecutar cuando se cambie el valor de marca
	 */
	$('#ProductBrandId').change(function() {
		var brand_id = document.getElementById('ProductBrandId').value;
		jQuery.ajax({
			url : "/subcategories/getBrandCategory/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var myObject = eval(data);
					document.getElementById('ProductCategory').value = myObject.Category.name;
				} else {
					alert("Error");
				}
			}
		});
		jQuery.ajax({
			url : "/subcategories/listBrandCategories/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var categories = eval(data);
					$("select[id$=ProductSubcategoryId] > option").remove();
					$.each(categories, function(index, value) {
						$('#ProductSubcategoryId').append($('<option></option>').val(index).html(value));
					});
				} else {
					alert("Error");
				}
			}
		});
		jQuery.ajax({
			url : "/collections/listBrandCollections/" + brand_id,
			type : "post",
			cache : false,
			dataType : "json",
			success : function(data) {
				if(data) {
					var categories = eval(data);
					$("select[id$=ProductCollectionId] > option").remove();
					$.each(categories, function(index, value) {
						$('#ProductCollectionId').append($('<option></option>').val(index).html(value));
					});
				} else {
					alert("Error");
				}
			}
		});
	});

</script>