<?php

namespace Controller;

use \W\Controller\Controller;

class TestController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function monaction()
	{
		$this->show('test/index');
	}

}
