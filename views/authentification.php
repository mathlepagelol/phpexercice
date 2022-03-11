<?php
//	Auteur:			    Mathieu Lepage
//	Description:		Page qui permet de s'identifier pour la création des variables sessions
//	Date de creation:	Avril 2020
//	But:			    Identifier l'utilisateur
// 	Modification : 		
/*****************************************************************************/
include("../calls/connexionBD.php");
include("../calls/config.php");
include("../class/managers/mgrUser.class.php");
include("../class/user.class.php");

session_start();
if (isset($_SESSION['login']))
{
    echo "Vous etes connectés en tant que " . $_SESSION['login'];
    header("Location: ../index.php");
}
//Si les informations d'authentification correspondent, on attribue des variables session.
else {
    if (isset($_POST['login']) && isset($_POST['password']))
    {
        if($_POST['login'] != "" && $_POST['password'])
        {
            $mgrUser = new mgrUser($db);
            $user = new user($_POST['login'], $_POST['password']);
            $reponse = $mgrUser->verificationUtilisateur($user->getUsername(),$user->getPassword());
            if ($reponse)
                $etat = 1; //Utilisateur connecté
            else
            $etat = 2; //Login ou Mot de passe incorrect
        }
        else
            $etat = 3; //Champ(s) vide(s)
    }
    $pageTitle = "Connexion";
    $pageContent = <<<EOT
                <form action="../pages/authentification.php" class="form-signin" method="post" align="center" size="100">
                    <label for="inputLogin" class="sr-only">Login</label>
                    <input type="text" id="inputLogin" class="form-control" placeholder="Login" name="login">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Se connecter">
                </form>
EOT;
    include("../Template.php");
    if(isset($etat))
    {
        switch($etat)
        {
            case 1 :
                echo "Connexion réussie !";
                $_SESSION['login'] = $_REQUEST["login"];
                header("Location: ../index.php");
                exit;
                break;
            case 2 :
                echo "Login ou mot de passe incorrect !";
                break;
            case 3 :
                echo "Tout les champs ne sont pas saisis !";
                break;
        }
    }
}
?>