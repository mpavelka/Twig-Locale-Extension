<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Locale.php';
require __DIR__ . '/LocaleTwigExtension.php';


// Create app
$app 		= new \Slim\App();
$container 	= $app->getContainer();


// Register Locale class
$container['locale'] = function($container)
{
	return new Locale(array(
		'langs' => array(
			"en",
			"cs"
		),
		'localePath' => __DIR__ . '/../locale'
	));
};

// Register Twig
$container['view'] = function ($container)
{
	$view = new \Slim\Views\Twig('../templates', array(
		//'cache' => '../cache'
	));

	// Register locale extension
	$view->addExtension(new Locale_Twig_Extension($container['locale']));

	// TODO: register router extension

	return $view;
};


// Views
require __DIR__ . '/views.php';


return $app;
