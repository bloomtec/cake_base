<div class="view-notifications">
	<div class="notifications">
		<?php
			foreach ($notifications as $key => $notification) {
		?>
		<div class="notification">
			<div class="notification-subject">
				<?=$notification['UserNotification']['subject']?>
			</div>
			<div class="notification-content">
				<?=$notification['UserNotification']['content']?>
			</div>
		</div>
		<?php
			}
		?>
	</div>
</div>