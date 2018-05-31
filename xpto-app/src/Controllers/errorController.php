<?php

namespace App\Controllers;

use App\Core\Controller;

Class errorController extends Controller
{
    public function __construct()
    {
        if ($this->isLogged() === false)
		{
			header('Location: ' . BASE_URL . '/login');
			exit;
		}
    }
    
    public function index()
    {
        header('Location: ' . BASE_URL);
    }
}