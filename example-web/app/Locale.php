<?php

class Locale
{
	private $config;
	private $lang;
	private $langCache;



	function __construct($config=array())
	{
		$this->config = array_merge(array(
			"localePath" => "./locale",
			"langs" => array(
				"en",
				"cs",
				"de"
			),
		), $config);
		$this->setLang($this->config["langs"][0]);
		$this->langCache = array();
	}


	public function setLang($lang)
	{
		// Set language if it exists in configured langs
		// otherwise select first lang from langs array
		if (!in_array($lang, $this->config["langs"]))
			$this->lang = $this->config["langs"][0];
		else
			$this->lang = $lang;
	}



	public function getLang()
	{
		return $this->lang;
	}



	public function getConfig()
	{
		return $this->config;
	}



	public function getText($textId)
	{
		$lang = $this->getLang();


		if (!isset($this->langCache[$lang])) {

			$file = $this->config["localePath"] . "/" . $this->getLang() . ".php";
			$locale = @include($file);

			if (gettype($locale) !== 'array')
				$this->langCache[$lang] = array();
			else
				$this->langCache[$lang] = $locale;
		}

		$locale = $this->langCache[$lang];

		if (!isset($locale[$textId]))
			return '';
		return $locale[$textId];
	}
}
