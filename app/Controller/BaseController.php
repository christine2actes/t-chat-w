<?php

namespace Controller;

use \W\Controller\Controller;
use \Model\SalonsModel;
use \Plasticbrain\FlashMessages\FlashMessages;

class BaseController extends Controller
{

    // Ce champ va définir l'engine de Plates qui va servir à afficher mes vues
    protected $engine;
    // Ce champ contiendra une instance de flash messenger de php-flash-messages
    protected $fmsg;

    public function __construct() {
        // J'appelle parent::__construct(); (construct de la classe parente) car je redéfinie le construct,
        // cela me permet de surcharger sans tout redéfinir
        // parent::__construct(); ERREUR !!!

        // Je stocke dans la variable de class engine une instance de League\Plates\Engine
        // alors que cette instance était créée directement dans la méthode show() de Controller
        $this->engine = new \League\Plates\Engine(self::PATH_VIEWS);

        //charge nos extensions (nos fonctions personnalisées)
		$this->engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		$app = getApp();
        $salonsModel = new SalonsModel();

        // J'instancie un objet de la class FlashMessage
        $this->fmsg = new FlashMessages();

		// Rend certaines données disponibles à tous les vues
		// accessible avec $w_user & $w_current_route dans les fichiers de vue
		$this->engine->addData(
			[
				'w_user' 		  => $this->getUser(),
				'w_current_route' => $app->getCurrentRoute(),
				'w_site_name'	  => $app->getConfig('site_name'),
                'salons'          => $salonsModel->findAll(),
                'fmsg'            => $this->getFlashMessenger(),
			]
		);

    }

    public function show($file, array $data = array()) {
        // Retire l'éventuelle extension .php
		$file = str_replace('.php', '', $file);

		// Affiche le template
		echo $this->engine->render($file, $data);
		die();
    }

    /*
    * Cette fonction sert à ajouter des données qui seront disponibles dans toutes les vues fabriquées par $this->engine (donc par la base controller)
    * @param array $datas
    * Exemple : pour ajouter une lsite d'utilisateurs à mes vues : $this->addGlobalData(array('users => $users'));
    */
    public function addGlobalData(array $datas) {
        $this->engine->addData($datas);
    }

    // Retourne une instance du flash messenger de php-flash-messages
    public function getFlashMessenger() {
        return $this->fmsg;
    }

}
