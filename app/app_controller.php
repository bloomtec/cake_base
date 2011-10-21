<?php
class AppController extends Controller {
	
	var $components = array(
		'Session',
		'Auth' => array(
			'fields' => array(
				'username' => 'email',
				'password' => 'password'
			)
		),
		'Email'
	);
	
	function beforeFilter() {
		   /* SMTP Options */
		if(isset($this->params["prefix"]) && $this->params["prefix"] == "admin"){
			$this->layout="ez/ez";
			$this->Auth->loginRedirect = array("controller" => "pages", "action" => "ez", "admin" => true);
			$this->Auth->deny($this->action);
		} else {
			$this->Auth->allow($this->action);
		}
	}
	
	function getList(){	
		return $this->$this->modelNames[0]->find("list");
	}
	
	function configEmail(){
		$this->Email->smtpOptions = array(
        	'port'=>'465', 
        	'timeout'=>'30',
        	'auth' => true,
        	'host' => 'ssl://smtp.gmail.com',
        	'username'=>'your_username@gmail.com',
        	'password'=>'your_gmail_password',
   		);
		$this->Email->delivery = 'smtp';
		/*
		 * 
		 * 
		$body='prueba';
		$nombrePara="";
	  	$subject="prueba";
	   	$correoPara="tatiana0204@gmail.com";
	    $this->Email->delivery = 'smtp';
	    $this->Email->from    = 'Aplicación Web Omega Ingenieros <no-responder@omegaingenieros.com>';
	    $this->Email->to      = $nombrePara.'<'.$correoPara.'>';
	    $this->Email->subject = $subject;
	    $this->Email->send($body); 
		 * */
		/* Do not pass any args to send() */
		$this->Email->send();
	/* Check for SMTP errors. */
		$this->set('smtp_errors', $this->Email->smtpError);
	   
	}
	
}
