<?php
namespace Validation\Exceptions;
/**
* Description of UserNameNotExists
* Cette classe sert à étendre les fonctionnalités de la bibliothèque respect/Validation en y ajoutant un nouveau validateur
**/

use \Respect\Validation\Exceptions\ValidationException;

class UsernameNotExistsException extends ValidationException {

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => [
            'Ce nom d\'utilisateur existe déjà'
        ],
        self::MODE_NEGATIVE => [
            'Ce nom d\'utilisateur existe déjà'
        ],
    );

}
