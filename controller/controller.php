<?php

class controller {
    
    //Retourne la page d'accueil
    static function accueil()
    {
        $view = new view('accueil');
        $view->template('template');
        $view->render();
    }

    //Retourne la page d'expériences
    static function experiences()
    {
        $view = new view('experiences');
        $view->template('template');
        $view->render();
    }
}