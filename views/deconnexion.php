<?php
//	Auteur:			    Mathieu Lepage
//	Description:		Page qui permet de déconnecter un utilisateur
//	Date de creation:	Avril 2020
//	But:			    Déconnecter l'utilisateur
// 	Modification : 		
/*****************************************************************************/
session_start();
session_destroy();
unset($_SESSION);
if(isset($_SESSION))
	echo "Erreur lors de la déconnexion";
else
{
    echo "Vous avez été déconnecté";
	header("Location: authentification.php");
    exit;
}
?>