<div class="users form tahoma">
<?php echo $this->Form->create('User');?>

<h1 class="orden twCenMt">Mis datos</h1>

	<fieldset>
		
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('email');
		echo $this->Form->hidden('pass',array('type'=>'password','label'=>'Password'));
		echo $this->Form->hidden('role_id',array('value'=>2));
		echo $this->Form->input('UserField.id');
		echo $this->Form->input('UserField.name',array('label'=>'Nombres'));
		echo $this->Form->input('UserField.surname',array('label'=>'Apellidos'));
		echo $this->Form->input('UserField.sex',array('label'=>'Sexo','options'=>array('Hombre','Mujer')));
		echo $this->Form->input('resultGeo',array('id'=>'resultGeo','label'=>'Buscar ciudad'));
		
		echo $this->Form->input('UserField.country',array('label'=>'Pais','class'=>'country','disabled'=>'disabled'));
		echo $this->Form->input('UserField.state',array('label'=>'Estado','class'=>'state','disabled'=>'disabled'));
		echo $this->Form->input('UserField.city',array('label'=>'Ciudad','class'=>'city','disabled'=>'disabled'));
		
		echo $this->Form->hidden('UserField.country',array('label'=>'Pais','id'=>'country'));
		echo $this->Form->hidden('UserField.state',array('label'=>'Estado','id'=>'state'));
		echo $this->Form->hidden('UserField.city',array('label'=>'Ciudad','id'=>'city'));
		
		echo $this->Form->input('UserField.address',array('label'=>'Dirección'));
		echo $this->Form->input('UserField.birthday',array('label'=>'Fecha de Nacimiento'));
		echo $this->Form->input('UserField.phone',array('label'=>'Telefono'));
		echo $this->Form->input('UserField.mobile',array('label'=>'Celular'));
		
	?>
	

	</fieldset>
	<input type="submit" class="input_verde" value="Guardar" />
	<a href='/users/profile' class="azul volver_profile"> Volver </a>
	
	
<?php echo $this->Form->end();?>


<?php echo $this->element('change-password');?>
</div>
<script type="text/javascript">
		$(function() {
		function log( city, state, country) {
			$('.city').val(city);
			$('.state').val(state);
			$('.country').val(country);
			
			$('#city').val(city);
			$('#state').val(state);
			$('#country').val(country);
			//$('#resultGeo').val(city+', '+state+', '+country);
		}

		$( "#resultGeo" ).autocomplete({
			source: function( request, response ) {
				$.ajax({
					url: "http://ws.geonames.org/searchJSON",
					dataType: "jsonp",
					data: {
						featureClass: "P",
						style: "full",
						maxRows: 12,
						name_startsWith: request.term
					},
					success: function( data ) {
						response( $.map( data.geonames, function( item ) {
							return {
								label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
								city: item.name,
								country: item.countryName,
								state:  item.adminName1 ? item.adminName1 : "", 
								value: item.name+', '+item.adminName1+', '+item.countryName
							}
						}));
					}
				});
			},
			minLength: 2,
			select: function( event, ui ) {
				log( ui.item.city ? ui.item.city: this.value, ui.item.city ? ui.item.state: '', ui.item.country ? ui.item.country:'');
			},
			open: function() {
				$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
			},
			close: function() {
				$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
			}
		});
	});
</script>