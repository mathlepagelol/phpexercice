<?php

class controller {
    
    //Retourne la page d'accueil
    static function accueil()
    {
        $view = new view('accueil');
        $view->template('template');
        $view->render();
    }

    //Retourne le formulaire de d'authentification
    static function show_login()
    {
        $view = new view('login');
        $view->template('template');
        $view->render();
    }

    //Retourne la vue du graphique
    static function chart()
    {
        $view = new view('chart');
        $view->template('template');
        $view->render();
    }

    //API 'call' pour aller chercher les données selon les dates entrées
    static function dataRequest()
    {
        echo api::post('getStats', post::array(), false);
    }

    //API 'call' pour aller chercher les informations d'authentification dans la DB
    static function login()
    {
        $login = api::post('login', post::array());
        if(isset($login->users_id))
            if(session::login($login->users_id, $login->username))
                session::redirect();
        else if(isset($login->message))
            session::redirect("connexion", $login->message);
    }

    //Retourne la vue d'inscription
    static function inscription_vue()
    {
        $view = new view('register');
        $view->template('template');
        $view->render();
    }

    //Retourne la vue du formulaire d'inscription
    static function inscription()
    {
        if(post::unset('password_confirm'))
        {
            $post = post::array();
            $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);
            $user = api::post('register', $post);
            if(isset($user->reussi))
            {
                session::login($user->users_id, $post['username']);
                session::redirect();
            }
            else
                session::redirect("inscription",$user->message);
        }
        else
            session::redirect("inscription", "Erreur lors de l'inscription");
    }
    
    //Fonction qui permet d'initialiser notre fichier à télécharger
    static function docs()
    {
        $filename = "/var/www/stats/documentation/manuelutilisation.pdf";
        //Définir les informations d'en-tête
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public');

        //Effacer le tampon de sortie du système
        flush();

        //Lire la taille du fichier
        readfile($filename);

        //Mettre fin au script
        die();
    }
    
    //Fonction qui permet de 'kill' les variables session
    static function logout()
    {
        session::logout();
    }
}