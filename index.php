<?php
//autoload des fichiers à include
foreach(['calls','class','controller','libs','managers'] as $folder)
{
    $scan_arr = scandir($folder);
    $files_arr = array_diff($scan_arr, array('.','..') );
    foreach($files_arr as $file)
    {
        require(__DIR__.'/'.$folder.'/'.$file);
    }
}
require 'vendor/autoload.php';

$head = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


if($head == '/' && $method == "GET") 
    controller::accueil(); //Affichage de la page d'accueil
else if($head == '/experiences' && $method == "GET")
    controller::experiences();


?>