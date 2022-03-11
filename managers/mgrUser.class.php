<?php
/*****************************************************************************/
//	Auteur:				Mathieu Lepage
//	Description:		Définition du manager des users et des méthodes
//                      d'accès à la BD
//	Date de creation:	Avril 2020
//	But:				Manipulation des Users par la programmation objet (POO)
/*****************************************************************************/
class mgrUser       // Définition de la classe
{
    private $db;            // Instance de PDO

    // Constantes d'accès à la BD
    const SERVEUR_SQL = "localhost";
    const BDD = "jeuvideo2";
    const USER = "root";
    const MDP = "";
       
    public function __construct($db)        // Permet de définir une instance PDO
    {
        $this->setdb($db);
    }

    public function setdb(PDO $db)
    {
        $this->db = $db;
    }

    //Fonction qui permet de vérier si les informations de login sont valides pour lui attribuer des variables sessions
    function verificationUtilisateur($login, $password)
    {
        $requeteUtilisateur = $this->db->prepare('SELECT `login`, `password` FROM `utilisateur` WHERE `login` = :paramLogin;');
        $requeteUtilisateur->bindParam('paramLogin',$login);
        $reponse = $requeteUtilisateur->execute();
        $resultat = $requeteUtilisateur->fetch(PDO::FETCH_ASSOC); //retourne un tableau indexé par le nom de la colonne
        if ($resultat != false)
        {
            if($password == $resultat['password'])
                return true;// Login & Password OK
            else
                return false;// Login OK & Password PAS OK
        }
        else
            return false;// Login PAS OK
        return $reponse;
    }
}
?>