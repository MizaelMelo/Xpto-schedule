<?php

namespace App\Controllers;

use App\Core\Controller, 
	Twig_Loader_Filesystem, 
	Twig_Environment;

Class agendaController extends Controller
{
	public function __construct(){

		if ($this->isLogged() === false)
		{
			header('Location: ' . BASE_URL . '/login');
			exit;
		}
		
		if(!isset($_SESSION['message']))
		{
			$_SESSION['message'] = md5(time() . rand(0,999));
		}
    }

    public function index($msg = '')
    {
		$json = $this->getInstance()->envia(API_URL . 'schedule', 'GET');
		$this->data['emp'] = json_decode($json);
		$this->data['BASE_URL'] = BASE_URL; 

		if (!empty($msg))
		{
			$this->data['m_bool'] = true;
			$this->data['message'] = $msg;
		}

		echo $this->load()->render('agenda.html', $this->getData());
	}

	public function edit($id)
	{
		if (isset($_POST['email']) && !empty($_POST['email']))
		{
			$dados = [
				'name' 	 => addslashes($_POST['name']),
				'phone'  => addslashes($_POST['tel']),
				'birth_date'  => addslashes($_POST['data']),
				'address' => addslashes($_POST['end'])
			];

			$this->getInstance()->update($dados, API_URL . "schedule/{$id[0]}");

			header('Location: ' . BASE_URL);
		}
	}
	public function add()
	{
		if (isset($_POST['email']) && !empty($_POST['email']))
		{
			$dados = [
				'name' 	 => addslashes($_POST['name']),
				'phone'  => addslashes($_POST['tel']),
				'birth_date'  => addslashes($_POST['data']),
				'address' => addslashes($_POST['end']),
				'email' => addslashes($_POST['email'])
			];

			$response = $this->getInstance()->send($dados, API_URL . 'schedule');

			$res = json_decode($response);
			
			if (empty($res))
			{
				$message = 'O e-mail informado já existe';
				$this->index($message);
				exit;
			}
			
			header('Location: ' . BASE_URL);
		}
	}

	public function delete($id)
	{
		$this->getInstance()->envia(API_URL . "schedule/{$id[0]}", 'DELETE');

		$message = 'Usuário excluido com sucesso';

		$this->index($message);
	}
		
	public function logout()
	{
		session_destroy(); 
        header("Location: " . BASE_URL);
        exit;	
	}

	public function __CALL($a, $b)
	{
		header('Location: ' . BASE_URL);
	}
}    
	
