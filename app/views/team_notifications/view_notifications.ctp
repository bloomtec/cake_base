<div class="view-notifications">
	<div class="notifications">
		<?php
			foreach ($notifications as $key => $notification) {
				$show_in_view = false;
				/**
				 * Verificar si la notificación es petición para ingresar al equipo
				 * Verificar si es así sí el usuario viendo las notificaciones es el capitan del equipo
				 */
				if(!empty($notification['TeamNotification']['player_id'])) {
					/**
					 * En este caso es petición de ingreso
					 */
					if($this->requestAction('/UsersTeams/isUserCaptain/'.$notification['TeamNotification']['team_id'])) {
						/**
						 * En este caso el usuario viendo las notificaciones es el capitan
						 * MOSTRAR LAS NOTIFICACIONES!
						 */
						$show_in_view = !$show_in_view;
					}
				} else {
					/**
					 * Aquí son otras notificaciones :: Por el momento mostrarlas
					 */
					$show_in_view = !$show_in_view;
				}
				if($show_in_view):
		?>
				<div class="notification">
					<div class="notification-subject">
						<?=$notification['TeamNotification']['subject']?>
					</div>
					<div class="notification-content">
						<?=$notification['TeamNotification']['content']?>
					</div>
				</div>
		<?php
				endif;
				}
		?>
	</div>
</div>