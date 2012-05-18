<?php
class NewsletterShell extends Shell {
	public function main() {
		$dateTimeInicio = new DateTime('11:00:00');
		$dateTimeActual = new DateTime('now');
		$dateTimeFin = new DateTime('12:00:00');
		$fechaInicio = $dateTimeInicio -> format('Y-m-d H:i:s');
		$fechaActual = $dateTimeActual -> format('Y-m-d H:i:s');
		$fechaFin = $dateTimeFin -> format('Y-m-d H:i:s');
		$this -> out('Horario inicial :: ' . $fechaInicio);
		$this -> out('Horario actual  :: ' . $fechaActual);
		$this -> out('Horario final   :: ' . $fechaFin);
		if($dateTimeInicio >= $dateTimeActual && $dateTimeActual <= $dateTimeFin) {
			$this -> out('Entre horario para enviar correo');
			$this -> out($this -> requestAction('/users/sendNewsletter'));
		} else {
			$this -> out($this -> requestAction('/users/sendNewsletter'));
			$this -> out('Fuera de horario para enviar correo');
		}
	}
}
?>