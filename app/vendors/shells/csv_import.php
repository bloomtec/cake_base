<?php
class CsvImportShell extends Shell {

	var $uses = array('CsvImport');

	function main() {
		// Obtener todas las fuentes csv disponibles en la carpeta
		// Cada archivo representa una tabla, la primera linea del archivo css serían las columnas
		// y la información entrada luego sería cada fila de datos para la tabla
		$names = array_flip($this -> CsvImport -> getDataSource() -> listSources());
		$data = array();
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
		print_r($data);
	}

}
