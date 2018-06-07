<?php

namespace App\Core;

use Twig_Loader_Filesystem, 
	Twig_Environment,
	Twig_Extension_Debug,
	App\Models\Api;

Class Controller
{
	/**
	 * Variavel que armazenará dados controlados pelos métodos das classes filhas 
	 * que enviam informações para as views. 
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * Variavel que carregará objeto de banco de dados deixando disponivel as classes
	 * filhas.
	 *
	 * @var object
	 */
	protected static $instance = null;

    public function __construct(){}

	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			self::$instance = new Api;
		}

		return self::$instance;
	}

    protected function getData()
    {
        return $this->data;
	}    

	public function load()
	{
		$loader = new Twig_Loader_Filesystem('src/Views');

		$twig = new Twig_Environment($loader, array('debug' => true));

		$twig->addExtension(new Twig_Extension_Debug());

		return $twig;
	}
	
	protected function isLogged() {
		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser']))
		{
			return true;
		}
		else {
			return false;
		}
	}

	public function debbug($data)
	{
		echo '<pre>';
		print_r($data);
		echo '<pre>';
		exit;
	}
}
