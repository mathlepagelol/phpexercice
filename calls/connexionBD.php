<?php
/*****************************************************************************/
//	Auteur:			Mathieu Lepage
//	Description:		Connexion à la base de données (à inclure partout partout!)
//	Date de creation:	Avril 2020
//	But:			Connecter l'application à la base de données
// 	Modification : 		
/*****************************************************************************/
try
{
        $db = new PDO('mysql:host=localhost;
                        dbname=jeuxvideo2;
                        charset=utf8', 
                        'root', 
                        '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>