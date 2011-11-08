<?php 
	class PandaTask extends Shell {
			
		public function initialize(){
			$this -> out('Initialize ');
		}
		public function execute() {
			$this->out(shell_exec('ls'));
			
		}
	}
?>