<?php

namespace Controller;

use \W\Controller\Controller;
use Model\SalonsModel;
use Model\MessagesModel;

class SalonController extends Controller
{

	/**
	 * Cette fonction sert à afficher le contenu (les messages) d'un seul salon
     * @param int $id : l'id du salon dont je cherche à voir les messages
	 */
	public function seeSalon($id)
	{
        // On instancie le modèle des salons de façon à récupérer les informations du salons dont l'id est passée dans l'url
        $salonsModel = new SalonsModel();
        // J'utilise la methode find() pour récupérer les infos du salon par son id
        $salon = $salonsModel -> find($id);

        // On instancie le modèle des messages pour récupérer les messages du salons dont l'id est passée dans l'url
        $messagesModel = new MessagesModel();
        // j'utilise la méthode search qui me permet d'exécuter la reqête suivante :
        // SELECT * FROM messages WHERE id_salon = $id
        // Cette méthode me renvoie l'équivalent d'un fetchAll, càd un tableau de tableau (tableau à deux dimentions)
        $messages = $messagesModel -> search(array ('id_salon' => $id), 'OR', FALSE);

        $this -> show('salons/see', array('salon' => $salon, 'messages' => $messages));
	}

}
