<?php

namespace Controller;

use \W\Controller\Controller;
use Model\UtilisateursModel;

class UserController extends Controller
{

	/**
	 * Cette fonction sert à afficher la liste des utilisateurs
	 */
	public function listUsers()
	{
		// Ici j'instancie depuis l'action du controleur un modele d'utilisateur pour pouvoir accéder à la liste des utilisateurs
		$usersModel = new UtilisateursModel();
		$usersList = $usersModel -> findAll();
		// la ligne suivante affiche la vue présente dans app/Views/users/list.php et y injecte le tableau $userList sous un nouveau nom listUsers
		$this -> show('users/list', array('listUsers' => $usersList));
	}

}
