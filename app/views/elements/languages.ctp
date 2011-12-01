<div class='languages'>
	<?php
	$links = array();
	$currentLanguage = Configure::read('Config.language');
	foreach (Configure::read('Config.languages') as $code => $language) {
		if ($code == $currentLanguage) {
			$links[] = $language;
		} else {
			$links[] = $this -> Html -> link($language, array('lang' => $code));
		}
	}
	echo implode(' - ', $links);
?>
</div>