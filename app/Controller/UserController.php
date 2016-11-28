<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;

class UserController extends BaseController
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

	public function login()
	{
		// Utiliser le modèle d'authentification avec la méthode isValidLoginInfo() avec en paramètre le pseudo/email et le password envoyé en post par l'utilisateur
		// après verif on récupère l'utilisateur en BDD et on le connecte et le redirige vers la page d'accueil

		// EXERCICE :
		// $auth = new AuthentificationModel();
		//
		// if ( isset($_POST) && isset($_POST['pseudo']) && isset($_POST['pass']) ) {
		// 	$pseudo = $_POST['pseudo'];
		// 	$pass = $_POST['pass'];
		// 	$result = $auth -> isValidLoginInfo($pseudo, $pass);
		// 		if ($result !== 0) {
		// 			$result -> getUserByUsernameOrEmail($pseudo);
		// 			$auth -> logUserIn($userInfos);
		// 			$this -> redirect('index');
		// 		}
		// }

		if ( !empty($_POST) ) {
			// $erreurs = array();
			if ( empty($_POST['pseudo'])) {
				// ajouter un message d'erreur
				// return $erreurs['pseudo'] = "Le champ pseudo est vide." ;
			}
			if ( empty($_POST['pass'])) {
				// ajouter un message d'erreur
			}

			$auth = new AuthentificationModel();

			if ( !empty($_POST['pseudo']) && !empty($_POST['pass']) ) {
				$pseudo = $_POST['pseudo'];
				$pass = $_POST['pass'];
				$idUser = $auth -> isValidLoginInfo($pseudo, $pass); // isValidLoginInfo renvoir l'id de l'utilisateur
				if ( $idUser !== 0 ) {
					$utilisateurModel = new UtilisateursModel();
					$userInfos = $utilisateurModel -> find($idUser);
					$auth -> logUserIn($userInfos);
					$this -> redirectToRoute('default_home');
				} else {
					// message d'erreur : infos de connexion incorrectes !
				}
			}

		}

		$this -> show('users/login', array('datas' => isset($_POST) ? $_POST : array()));
	}

	public function logout() {
		$auth = new AuthentificationModel();
		$auth -> logUserOut();
		$this -> redirectToRoute('login');
	}

}
