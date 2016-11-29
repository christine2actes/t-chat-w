<?php

namespace Controller;

use Model\UtilisateursModel;
use W\Security\AuthentificationModel;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

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
			if ( empty($_POST['pseudo'])) {
				// ajouter un message d'erreur avec la librairie
				$this->getFlashMessenger()->error('Vous n\'avez pas renseigné votre pseudo');
			}
			if ( empty($_POST['pass'])) {
				// ajouter un message d'erreur
				$this->getFlashMessenger()->error('Vous n\'avez pas renseigné votre mot de passe');
			}

			$auth = new AuthentificationModel();

			// if ( !empty($_POST['pseudo']) && !empty($_POST['pass']) ) {
			if ( ! $this->getFlashMessenger()->hasErrors() ) {
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
					$this->getFlashMessenger()->error('Vos informations de connexion sont incorrectes !');
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

	public function register() {
		if( !empty($_POST) ) {

			// on indique à respect validation que nos règles de validation (custom) seront accessibles depuis le namespace Validation\Rules
			v::with("Validation\Rules");

			$validators = array(
				'pseudo' => v::length(3,50)
					->alnum()
					->noWhiteSpace()
					->usernameNotExists()
					->setName('Pseudo'),

				'email' => v::email()
					->EmailNotExists()
					->setName('E-mail'),

				'pass' => v::length(3,50)
					->alnum()
					->noWhiteSpace()
					->setName('Mot de passe'),

				'sexe' => v::in(array('femme', 'homme', 'non-défini')),

				'avatar' => v::optional(
					v::image()
					->size('1MB')
					->uploaded()),
			);

			$datas = $_POST;

			// on ajoute le chemin vers le fichier d'avatar qui a été uploadé (s'il y en a un)
			if( !empty($_FILES['avatar']['tmp_name']) ) {
				// je sstocke en données à valider le chemin vers la localisation temporaire de l'avatar
				$datas['avatar'] = $_FILES['avatar']['tmp_name'];
			} else {
				$datas['avatar'] = '';
			}

			// Je parcours la liste de mes validateurs en récupérant aussi le nom du champ en clé
			foreach ($validators as $field => $validator) {
				// la méthode assert renvoie une exception de type NestedValidationException qui nous permet de récupérer le ou les messages d'erreur
				try {
					// on esssaye de valider la donnée
					// si une exception se produit, c'est le block catch qui sera exécuté
					$validator->assert(isset($datas[$field]) ? $datas[$field] : 'Sexe');
				} catch (NestedValidationException $ex) { // $ex (erreur) de type NestedValidationException (nature de l'objet qu'on manipule)
					$fullMessage = $ex->getFullMessage();
					$this->getFlashMessenger()->error($fullMessage);
				}
			}

			if ( ! $this->getFlashMessenger()->hasErrors() ) {
				// s'il n'y a aucune erreur, on procède à l'insertion en BDD du nouvel utilisateur
				// avant l'insertion on doit déplacer l'avatar du fichier tmp vers le dossier avatar et hacher le mot de passe

				// pour hacher le mot de passe, on utilise le modèle AuthentificationModel
				$auth = new AuthentificationModel();
				$datas['pass'] = $auth->hashPassword($datas['pass']);

				$initialAvatarPath = $_FILES['avatar']['tmp_name'];
				$avatarNewName = md5(time() . uniqid());
				$targetPath = realpath('assets/uploads');
				move_uploaded_file($initialAvatarPath, $targetPath . '/' . $avatarNewName);

				// On met à jour le nouveau nom de l'avatar dans $datas pour l'insérer dans la BDD
				$datas['avatar'] = $avatarNewName;

				// Insertion dans la BDD
				$utilisateursModel = new UtilisateursModel();
				unset($datas['send']);
				$userInfos = $utilisateursModel->insert($datas);
				$auth-> logUserIn($userInfos);
				$utilisateursModel->insert($datas);

				$this->getFlashMessenger()->success('Vous êtes bien inscrit à T\'chat');

				$this->redirectToRoute('default_home');
			}
		}


		$this->show('users/register');
	}

}
























////
