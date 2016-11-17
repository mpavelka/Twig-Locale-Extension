<?php


$app->get('/[lang/{lang}]', function($request, $response, $args) use ($container) {

	$lang = null;


	if (isset($args['lang'])) {

		// Is lang supported?
		if (!in_array($args['lang'], $this->locale->getConfig()["langs"]))
			return $container['notFoundHandler']($request, $response, $args);
		$lang = $args['lang'];
	}
	else {
		// Detect language (TODO)
		$lang = 'en';
	}
	
	// Set locale
	$this->locale->setLang($lang);

	// Render view
	$this->view->render($response, 'index.html', array(
		'lang' => $this->locale->getLang()
	));

	// Return response
	return $response->withStatus(200);
});

