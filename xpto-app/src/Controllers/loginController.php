<?php

namespace App\Controllers;

use App\Core\Controller, 
	App\Models\Api,
	Twig_Loader_Filesystem, 
	Twig_Environment;

Class loginController extends Controller
{
	public function __construct()
	{
		if ($this->isLogged() === true)
		{
			header('Location: ' . BASE_URL);
			exit;
		}

		if(!isset($_SESSION['xpto_csrf_token']))
		{
			$_SESSION['xpto_csrf_token'] = md5(time() . rand(0,999));
		}
	}

	public function index() 
	{
		// Carrega o template com as informações
		echo $this->load()->render('login.html', array('BASE_URL' => BASE_URL, 'url' => BASE_URL . '/login/logged', 't_token' => $_SESSION['xpto_csrf_token']));
    }
	
	public function logged()
	{
		if (isset($_POST['email']) && !empty($_POST['email']))
		{
			$dados = [
				'email' => addslashes($_POST['email']),
				'password'  => addslashes($_POST['password'])
			];

			$token = addslashes($_POST['t_token']);

			if ($_SESSION['xpto_csrf_token'] === $token)
			{
				$api = new Api;
				$res = $api->send($dados, API_URL . 'auth/login', ['email']);

				$json = json_decode($res);

				if (isset($json->token))
				{	
					$_SESSION['ccUser'] = $json->token;
					header('Location: ' . BASE_URL);
					exit;
				}
				else {
					echo $this->load()->render('login.html', array('BASE_URL' => BASE_URL, 'url' => BASE_URL . '/login', 't_token' => $_SESSION['xpto_csrf_token'], 'msg' => 'Usuário e/ou senha inválido'));
				}
			}
			else {
				echo "Acesso restrito!";
				exit;
			}
		}
		else {
			header('Location: ' . BASE_URL);
		}
	}

    public function __CALL($a, $b)
    {
        header('Location: ' . BASE_URL . '/login');
		exit;
    }
}