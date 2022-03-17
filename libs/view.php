<?php

class view{
    
    public $view;
    
    //Fonction qui prépare le body de la page - constructeur de l'objet vue
    public function __construct($nom = null)
    {
        if($nom != null){
            ob_start(); //commencer à capturer la sortie
            include('views/'.$nom.'.php'); //exécute le fichier
            $this->view = ob_get_contents(); //obtenir le contenu du tampon
            ob_end_clean();
        }
    }

    //Fonction qui prépare le body de la template
    public function template($nom = null)
    {
        if($nom != null)
        {
            ob_start(); //commencer à capturer la sortie
            include('views/'.$nom.'.php'); //exécute le fichier
            $template = ob_get_contents(); //obtenir le contenu du tampon
            ob_end_clean();
            $this->view = str_replace('@pageContent', $this->view, $template);
        }
    }

    //Fonction qui 'construit' la view
    public function render(){
        echo $this->view;
    }
}