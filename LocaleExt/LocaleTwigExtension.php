<?php

class Locale_Twig_Extension extends Twig_Extension
{
	private $locale;

	function __construct(&$locale)
	{
		$this->locale = $locale;
	}

	public function getFunctions()
	{
		return array(
			new Twig_SimpleFunction('_', function($textId)
			{
				return $this->locale->getText($textId);
			}),
		);
	}
}
