<?php
/*****************************************************************************/
//	Auteur:			    Mathieu Lepage
//	Description:		Configuration de base de l'application
//	Date de creation:	Avril 2020
//	But:			    Avoir une configuration uniforme dans toutes les pages de l'app
// 	Modification : 		
/*****************************************************************************/
//Personnalisaton de la configuration PHP :
// activation des informations d'erreur
// affichage à l'écran
ini_set('display_errors', 1);
// écriture dans un fichier logs
ini_set('log_errors', 1);
ini_set('error_log', "phperror.log");
// choix des types d'erreur concernés
// toutes les erreurs
error_reporting(E_ALL);
?>