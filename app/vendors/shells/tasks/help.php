<?php
class HelpTask extends Shell {
	public $parameters = array();
	public $arguments = array();
	protected $commands = array();
	public function initialize() {
		$shellClass = Inflector::camelize($this -> shell) . 'Shell';
		$vars = get_class_vars($shellClass);
		if (!empty($vars['commands'])) {
			foreach ($vars['commands'] as $command => $settings) {
				if (is_numeric($command)) {
					$command = $settings;
					$settings = array();
				}
				if (!empty($settings['args'])) {
					$args = array();
					foreach ($settings['args'] as $argName => $arg) {
						if (is_numeric($argName)) {
							$argName = $arg;
							$arg = array();
						}
						$args[$argName] = array_merge(array('help' => null, 'mandatory' => false), $arg);
					}
					$settings['args'] = $args;
				}
				if (!empty($settings['params'])) {
					$params = array();
					foreach ($settings['params'] as $paramName => $param) {
						if (is_numeric($paramName)) {
							$paramName = $param;
							$param = array();
						}
						$params[$paramName] = array_merge(array('help' => null, 'type' => 'string'), $param);
					}
				}
				$this -> commands[$command] = array_merge(array('help' => null, 'args' => array(), 'params' => array()), $settings);
			}
		}
		if (empty($this -> command) && !in_array('main', get_class_methods($shellClass))) {
			$this -> _welcome();
			$this -> _help();
		} elseif (!empty($this -> command) && array_key_exists($this -> command, $this -> commands)) {
			$command = $this -> commands[$this -> command];
			$number = count(array_filter(Set::extract(array_values($command['args']), '/mandatory')));
			if ($number > 0 && (count($this -> args) - 1) < $number) {
				$this -> err('WRONG number of parameters');
				$this -> out();
				$this -> _help($this -> command);
			} elseif ($number > 0) {
				$i = 0;
				foreach ($command['args'] as $argName => $arg) {
					if ($number >= $i && isset($this -> args[$i + 1])) {
						$this -> arguments[$argName] = $this -> args[$i + 1];
					}
					$i++;
				}
			}
			$values = array_intersect_key($this -> params, $command['params']);
			foreach ($command['params'] as $settingName => $setting) {
				if (!array_key_exists($settingName, $values)) {
					$this -> parameters[$settingName] = array_key_exists('value', $setting) ? $setting['value'] : null;
				} elseif ($setting['type'] == 'int' && !is_numeric($values[$settingName])) {
					$this -> err('ERROR: wrong value for ' . $settingName);
					$this -> out();
					$this -> _help($this -> command);
				} else {
					if ($setting['type'] == 'bool') {
						$values[$settingName] = !empty($values[$settingName]);
					}
					$this -> parameters[$settingName] = $values[$settingName];
				}
			}
		}
	}

	public function execute() {
		$this -> _help(!empty($this -> args) ? $this -> args[0] : null);
	}

	protected function _help($command = null) {
		$usage = 'cake ' . $this -> shell;
		if (empty($this -> commands)) {
			$this -> out($usage);
			return;
		}
		$lines = array();
		$usages = array();
		if (empty($command) || !array_key_exists($command, $this -> commands)) {
			foreach (array_keys($this->commands) as $currentCommand) {
				$usages[] = $this -> _usageCommand($currentCommand);
				if (!empty($lines)) {
					$lines[] = null;
				}
				$lines = array_merge($lines, $this -> _helpCommand($currentCommand));
			}
		} else {
			$usages = (array)$this -> _usageCommand($command);
			$lines = $this -> _helpCommand($command);
		}
		if (!empty($usages)) {
			$usage .= ' ';
			if (empty($command)) {
				$usage .= '<';
			}
			$usage .= implode(' | ', $usages);
			if (empty($command)) {
				$usage .= '>';
			}
		}
		$this -> out($usage);
		if (!empty($lines)) {
			$this -> out();
			foreach ($lines as $line) {
				$this -> out($line);
			}
		}
		$this -> _stop();
	}

	protected function _usageCommand($command) {
		$usage = $command;
		if (!empty($this -> commands[$command]['args'])) {
			foreach ($this->commands[$command]['args'] as $argName => $arg) {
				$usage .= ' ' . ($arg['mandatory'] ? '<' : '[');
				$usage .= $argName;
				$usage .= ($arg['mandatory'] ? '>' : ']');
			}
		}
		if (!empty($this -> commands[$command]['params'])) {
			$usages = array();
			foreach (array_keys($this->commands[$command]['params']) as $setting) {
				$usages[] = $this -> _helpSetting($command, $setting);
			}
			$usage .= ' [' . implode(' | ', $usages) . ']';
		}
		return $usage;
	}

	protected function _helpCommand($command) {
		if (empty($this -> commands[$command]['args']) && empty($this -> commands[$command]['params'])) {
			return array();
		}
		$lines = array('Options for ' . $command . ':');
		foreach ($this->commands[$command]['args'] as $argName => $arg) {
			$lines[] = "\t" . $argName . (!empty($arg['help']) ? "\t\t" . $arg['help'] : '');
		}
		foreach (array_keys($this->commands[$command]['params']) as $setting) {
			$lines[] = "\t" . $this -> _helpSetting($command, $setting, true);
		}
		return $lines;
	}

	protected function _helpSetting($command, $settingName, $useHelp = false) {
		$types = array('int' => 'N', 'string' => 'S', 'bool' => null);
		$setting = $this -> commands[$command]['params'][$settingName];
		$type = array_key_exists($setting['type'], $types) ? $types[$setting['type']] : null;
		$help = '-' . $settingName . (!empty($type) ? ' ' . $type : '');
		if ($useHelp && !empty($setting['help'])) {
			$help .= "\t\t" . $setting['help'];
			if (array_key_exists('value', $setting) && !is_null($setting['value'])) {
				$help .= '. DEFAULTS TO: ';
				if (empty($type)) {
					$help .= $setting['value'] ? 'Enabled' : 'Disabled';
				} else {
					$help .= $setting['value'];
				}
			}
		}
		return $help;
	}

}
