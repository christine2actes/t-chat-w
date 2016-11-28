<?php

namespace Controller;

class TestController extends BaseController
{

	/**
	 * Page d'accueil par défaut
	 */
	public function monaction()
	{
		$this->show('test/index');
	}

}
