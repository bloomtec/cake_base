<?php
class CsvImportShell extends Shell {

	var $uses = array('CsvImport');

	function main() {
		// Obtener todas las fuentes csv disponibles en la carpeta
		// Cada archivo representa una tabla, la primera linea del archivo css serían las columnas
		// y la información entrada luego sería cada fila de datos para la tabla
		$names = array_flip($this -> CsvImport -> getDataSource() -> listSources());
		
		// Arreglo en el que van a quedar todos los datos
		$data = array();
		
		// Recorrer las fuentes csv y recoger la información
		foreach ($names as $name => $null) {
			$this -> CsvImport -> table = $name;
			$itemArray = array();
			$itemArray[$name] = array();
			$items = $this -> CsvImport -> find('all');
			foreach ($items as $key => $value) {
				$itemArray[$name][] = $value;
			}
			$data = array_merge($data, $itemArray);
		}
		
		foreach( $data as $modelo => $info ) {
			// Cargar los modelos necesarios para trabajar
			App::import('Model', $modelo);
			$Modelo = new $modelo();
			foreach($info as $item) {
				$max_id = $Modelo -> find('first', array('fields' => array("MAX($modelo.id) as max_id")));
				$id = $max_id[0]['max_id'] += 1;
				$tmpItem = array();
				$tmpItem["$modelo"] = $item;
				$tmpItem["$modelo"]['id'] = $id;
				$Modelo -> save($tmpItem);				
			}
		}
		
	}

}
