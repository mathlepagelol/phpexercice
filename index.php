<?php
/*****************************************************************************/
//	Auteur:				Antoine Pierre
//	Description:		Programme de gestion des jeux vidéos
//	Date de creation:	Mars 2020
//	But:				Affichage et MAJ des jeux vidéos
//
//  Auteur modif:       Mathieu Lepage
//	Date de creation:	23 avril 2020
// 	Modification : 		Adaptation POO pour l'ajout, la modification et la suppression d'un jeu en utilisant 
//                      la class jeuvideo et le manager associé
/*****************************************************************************/
include('calls/config.php');
include('calls/connexionBD.php');

session_start();
if(isset($_SESSION['login']))
{
    if(isset($_POST['action']))
    {
        if($_POST['action'] == "A")
        {
            // Il y a un jeu à ajouter
            // Récupérer d'abord les infos du formulaire dans un objet jeuvideo
            include ('class/jeuvideo.class.php');

            $nomJeu = $_POST['nom'];
            $genres = $_POST['genres'];
            $plateformes = $_POST['plateformes'];

            $jeuvideo = new JeuVideo($_POST['nom'], $_POST['description'], $_POST['dateSortie'], $_POST['idEditeur'],$_POST['prix'],$_POST['appreciationMoy'], $_POST['multiJoueur'], $_POST['quantiteEnStock']);
            include_once('class//managers/mgrJeuVideo.class.php');

            // Appeler le manager afin d'ajouter le jeu dans la BD
            $mgrJeuVideo = new mgrJeuVideo($db);
            $reponse = $mgrJeuVideo->ajouterJeuVideo($jeuvideo);

            $idJeu = $mgrJeuVideo->dernierIdInsere();

            foreach($genres as $genre)
            {
                $ajoutGenreRequete = $mgrJeuVideo->ajouterGenreJeu($idJeu, $genre);
                if(!$ajoutGenreRequete)
                echo "Une erreur s'est produite lors de l'ajout d'un nouveau genre";
            }
            foreach($plateformes as $plateforme)
            {
                $ajoutPlateformeRequete = $mgrJeuVideo->ajouterPlateformeJeu($idJeu, $plateforme);
                if(!$ajoutPlateformeRequete)
                echo "Une erreur s'est produite lors de l'ajout d'une nouvelle plateforme";
            }

            // Informez l'usager du résultat de l'insertion
            if ($reponse)
                echo "Jeu ajouté !";
            else
                echo "Erreur lors de l'ajout du jeu";
        }

        if($_POST['action'] == "M")
        {
            // Il y a un jeu à modifier
            // Récupérer d'abord les infos du formulaire dans un objet jeuvideo
            $id = (int)$_POST['id'];
            include ('class/jeuvideo.class.php');
            $jeuvideo = new JeuVideo($_POST['nom'], $_POST['description'], $_POST['dateSortie'], $_POST['idEditeur'],$_POST['prix'],$_POST['appreciationMoy'], $_POST['multiJoueur'], $_POST['quantiteEnStock']);
            include_once('class/managers/mgrJeuVideo.class.php');
            $genres = $_POST['genres'];
            $plateformes = $_POST['plateformes'];
            
            //Modifie le jeu dans la BDD
            $mgrJeuVideo = new mgrJeuVideo($db);
            $reponseRequete = $mgrJeuVideo->miseAjourJeuVideo($id, $jeuvideo->getNom(), $jeuvideo->getDescription(), $jeuvideo->getDateSortie(), $jeuvideo->getEditeurId(), $jeuvideo->getPrix(), $jeuvideo->getAppreciationMoy(), $jeuvideo->getMultijoueur(), $jeuvideo->getQuantiteEnStock());
            $reponseSupprGenres = $mgrJeuVideo->supprimerGenreJeu($id);
            $reponseSupprPlateformes = $mgrJeuVideo->supprimerPlateformeJeu($id);
            if (!$reponseSupprGenres || !$reponseSupprPlateformes)
            {
                echo "Erreur de suppression des anciens genres et/ou anciennes plateformes du jeu";
                //exit;
            }
            foreach ($genres as $genre)
            {
                $requeteAjoutGenre = $mgrJeuVideo->ajouterGenreJeu($id, $genre);
                if (!$requeteAjoutGenre)
                {
                    echo "Erreur lors de l'ajout d'un nouveau genre du jeu";
                    //exit;
                }
            }
            foreach ($plateformes as $plateforme)
            {
                $requeteAjoutPlateforme = $mgrJeuVideo->ajouterPlateformeJeu($id, $plateforme);
                if (!$requeteAjoutPlateforme)
                {
                    echo "Erreur lors de l'ajout d'une nouvelle plateforme du jeu";
                    //exit;
                }
            }
            if ($reponseRequete)
                echo "Jeu modifié !";
            else
                echo "Erreur lors de la modification du jeu";
        }

        if($_POST['action'] == "S")
        {
            $id = $_POST['id'];
            //Supprimer l'article dans la BDD
            include_once("class/managers/mgrJeuVideo.class.php");
            $mgrJeuVideo = new mgrJeuVideo($db);
            $requeteSupprimerGenres = $mgrJeuVideo->supprimerGenreJeu($id);
            $requeteSupprimerPlateformes = $mgrJeuVideo->supprimerPlateformeJeu($id);
            if ($requeteSupprimerGenres == false || $requeteSupprimerPlateformes == false)
            {
                echo "Erreur de suppression des genres et/ou des plateformes du jeu. Le jeu n'a pas pu être supprimé.";
                exit;
            }
            $reponseRequete = $mgrJeuVideo->supprimerJeuVideo($id);
            if ($reponseRequete)
                echo "Jeu supprimé !";
            else
            {
                echo "Erreur lors de la suppression du jeu";
                exit;
            }
        }
    }

    include_once("class/managers/mgrJeuVideo.class.php");
    $mgrJeuVideo = new mgrJeuVideo($db);
    $jeux = $mgrJeuVideo->selectionnerJeuVideo();
    $pageTitle = "Les Jeux-Vidéos";

    $pageContent = "Connecté en tant que " . $_SESSION['login'] . ". <a href='pages/deconnexion.php'>Se déconnecter</a><br><br>";
    $pageContent .= "<a href='pages/jeuvideo/ajouterJeuVideo.php'><input type='button' value='Ajouter un jeu-vidéo' class='btn btn-info'></a> <a href='pages/genre/indexGenre.php'><input type='button' value='Gestion des genres' class='btn btn-info'></a> <a href='pages/plateforme/indexPlateforme.php'><input type='button' value='Gestion des plateformes' class='btn btn-info'></a> <a href='pages/editeur/indexEditeur.php'><input type='button' value='Gestion des éditeurs' class='btn btn-info'></a> <br><br>";
    $pageContent .= "<h2 style='font-size : 20px;'>Liste des jeux-vidéos : </h2><br><br> <table>";
    foreach ($jeux as $item) 
    {
        $pageContent .= "<tr><td><a href='pages/jeuvideo/afficherJeuVideo.php?id=".$item['id']."'>" . $item['nom'] . "</td>";
        $pageContent .= "<td><a href='pages/jeuvideo/modifierJeuVideo.php?id=".$item['id'].'&nom='.$item['nom'].'&description='.$item['description'].'&dateSortie='.$item['dateSortie'].'&idEditeur='.$item['editeur_id'].'&prix='.$item['prix'].'&appreciationMoy='.$item['appreciationMoy'].'&multiJoueur='.$item['multiJoueur'].'&quantiteEnStock='.$item['quantiteEnStock']."'><input type='button' value='Modifier' class='btn btn-primary'></a></td>";
        $pageContent .= "<td><a href='pages/jeuvideo/supprimerJeuVideo.php?id=".$item['id'].'&nom='.$item['nom']."'><input type='button' value='Supprimer' class='btn btn-danger'></a></td></tr>";
    }
    $pageContent .= "</table> <br> <br>";

    include("Template.php");
}
else
{
    header("Location: pages/authentification.php");
    exit;
}
?>