<?php
App::import('Component', 'Auth');
class UserShell extends Shell {
	
	public $uses = array('User');
	public $tasks = array('Panda','Help');
	public static $commands = array(
		'add', 
		'import' => array(
			'help' => 'Import user records from a CSV file', 
			'args' => array(
				'path' => array(
					'help' => 'Path to CSV file', 
					'mandatory' => true)
			), 
			'params' => array(
				'limit' => array(
					'type' => 'int', 
					'help' => 'import up to N records'
					), 
				'size' => array(
					'value' => 10, 
					'type' => 'int', 
					'help' => 'size of generated password'
				), 
				'verbose' => array(
					'value' => false, 
					'type' => 'bool', 
					'help' => 'Verbose output'
				)
			)
		)
	);

	public function add() {
		$this -> Auth = new AuthComponent();
		$email = $this -> in('Enter the email (ENTER to abort):');
		if (empty($email)) {
			$this -> _stop();
		}
		$defaultPassword = $this -> _randomPassword();
		$password = $this -> in('Enter the password (ENTER to use generated):', null, $defaultPassword);
		$defaultRole = 2;
		$roleId = $this -> in('Enter the role (ENTER to use 2):', null, $defaultRole);
		$this -> out();
		$this -> out('USER: ' . $email);
		$this -> out('PASSWORD: ' . $password);
		$this -> out();
		if (strtoupper($this -> in('Proceed?', array('Y', 'N'), 'N')) != 'Y') {
			$this -> _stop();
		}
		$email = array('User' => array('email' => $email, 'role_id' => $roleId, 'password' => $this -> Auth -> password($password)));
		$this -> User -> create();
		if ($this -> User -> save($email)) {
			$this -> out('User created.');
		} else {
			$this -> error('Error while creating user.');
		}
	}

	public function import() {
		$options = $this -> Help -> parameters;
		extract($this -> Help -> arguments);

		if (!is_file($path) || !is_readable($path)) {
			$this -> error('File ' . $path . ' cannot be read');
		}
		$users = array();
		foreach ($this->_parseCSV($path) as $i => $row) {
			$users[$row[0]] = $this -> _randomPassword($options['size']);
			if (!empty($options['limit']) && $i + 1 == $options['limit']) {
				break;
			}
		}
		if ($options['verbose']) {
			$this -> out('Will create ' . number_format(count($users)) . 'accounts');
		}
		foreach ($users as $email => $password) {
			if ($options['verbose']) {
				$this -> out('Creating user ' . $email . '... ', false);
			}
			$user = array('User' => array('email' => $email, 'password' => Security::hash($password, null, true)));
			$this -> User -> create();
			$saved = ($this -> User -> save($user) !== false);
			if (!$saved) {
				unset($users[$email]);
			}
			if ($options['verbose']) {
				$this -> out($saved ? 'SUCCESS' : 'FAIL');
			}
		}
		$this -> out('Created accounts:');
		foreach ($users as $email => $password) {
			$this -> out($email . ' : ' . $password);
		}
	}

	protected function _randomPassword($size = 10) {

		$chars = '@!#$_';
		foreach (array('A'=>'Z', 'a'=>'z', '0'=>'9') as $start => $end) {
			for ($i = ord($start), $limiti = ord($end); $i <= $limiti; $i++) {
				$chars .= chr($i);
			}
		}
		$totalChars = strlen($chars);
		$password = '';
		for ($i = 0; $i < $size; $i++) {
			$password .= $chars[rand(0, $totalChars - 1)];
		}
		return $password;
	}

	protected function _parseCSV($path) {
		$file = fopen($path, 'r');
		if (!is_resource($file)) {
			$this -> error('Can\'t open ' . $file);
		}
		$rows = array();
		while ($row = fgetcsv($file)) {
			$rows[] = $row;
		}
		fclose($file);
		return $rows;
	}

}
?>