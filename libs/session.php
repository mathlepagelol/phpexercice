<?php

class session{

    //Fonction qui permet de set l'username et le ID via set()
    public static function login($id, $name)
    {
        self::set('users_id', $id);
        self::set('username', $name);
        return true;
    }

    //Fonction qui permet de se déconnecter
    public static function logout()
    {
        $_SESSION = array();

        // Si nous souhaitons arrêter la session, supprimez également le cookie de session
        // PS: cela détruira la session (pas seulement les données de session)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_regenerate_id();
        //Destruction de la session
        session_destroy();
        session_start();
        //On redirect à la page d'authentification
        self::redirect('login', 'Déconnexion réussie');
    }

    //Fonction qui 'set' les variables sessions
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    //Fonction qui 'return' une variable session
    public static function get($key)
    {
        return $_SESSION[$key];
    }

    //Fonction qui permet de faire la gestion des msg d'erreur
    public static function get_one($key)
    {
        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }

    //Fonction qui permet de vérifier si une session est active
    public static function is_logged()
    {
        return $_SESSION['users_id'];
    }

    //Fonction qui permet de faire la redirection de page
    public static function redirect($url = '', $erreur = null)
    {
        self::set('erreur', $erreur);
        header('Location: /'.$url);
        exit();
    }
}