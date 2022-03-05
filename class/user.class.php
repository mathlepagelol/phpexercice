<?php
/*****************************************************************************/
//	Auteur:			    Mathieu Lepage
//	Description:		Attributs, Méthodes et Constructeur de la classe User
//	Date de creation:	Avril 2020
//	But:			    Permettre de créer un objet User
// 	Modification : 		
/*****************************************************************************/
class user
{
    private $id;
    private $username;
    private $password;

    public function __construct($username, $password) // Permet de définir une instance PDO
    {
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function getUsername()
    {
        return $this->username;
    }
    
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

?>