<?php
class NewsletterShell extends Shell {
	public function main() {
		$this -> out('prueba');
		$date = date('Y-m-d H:i:s');
		$this -> out($date);
		$this -> out('fin prueba');
	}	
}
?>