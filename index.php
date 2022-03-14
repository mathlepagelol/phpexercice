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
$pageTitle = "CURRICULUM VITAE";
$pageContent = <<<EOT
<div id="mainDiv">
    <div>
        <div>
            <p id="infosPersos">
                <strong>Mathieu Lepage</strong><br>
                790, ave. Myrand, app. 3 <br>Québec (Québec) G1V 2V2 <br><br> Téléphone : (581) 994-8482 (cellulaire) <br><br> Courriel : Mat_182_42@hotmail.com<br>
                Disponibilités : En tout temps<br><strong>Langues parlées et écrites : Français et anglais</strong><br><br>
            </p>
        </div>
        <div id="formation">
        <strong>FORMATIONS</strong>
            <div>
                <p>Août 2018 - Mai 2021</p>
                <p>Diplôme d'étude Collégial<br>Informatique - Développement Web<br>Cégep de Rivière-du-Loup</p>
            </div>
            <div>
                <p>Décembre 2015 - Avril 2016</p>
                <p>Certificat en psychologie<br>(Formation non-complétée)<br>Université TÉLUQ</p>
            </div>
            <div>
                <p>Septembre 2012 - Juillet 2013</p>
                <p>Attestation d'étude collégiales<br>(Formation non complétée)<br>Informatique - Architecture et gestion de réseaux<br>Cégep de l'Outaouais</p>
            </div>
            <div>
                <p>Juin 2010</p>
                <p>Diplôme d'études secondaires<br>École secondaire de Rivière-du-Loup</p>
            </div>
        </div>
    </div>
    <div id="competencesTechniques">
        <strong>COMPÉTENCES TECHNIQUES EN INFORMATIQUE</strong>
        <table id="tableCompetence">
            <tr>
                <th>Sujet</th>
                <th>Compétence</th>
            </tr>
            <tr>
                <td>Programmation</td>
                <td>C#, PHP, Javascript</td>
            </tr>
            <tr>
                <td>Systèmes d'exploitation</td>
                <td>Windows, Linux (Debian), Windows Server</td>
            </tr>
            <tr>
                <td>Bases de données</td>
                <td>MySQL, NoSQL</td>
            </tr>
            <tr>
                <td>Logiciels</td>
                <td>Suite Office Microsoft</td>
            </tr>
            <tr>
                <td>Introduction - Fondamentals</td>
                <td>CISCO CCNA</td>
            </tr>
        </table>
        <p style="margin-top:10px;">
                <strong>SOMMAIRE DES COMPÉTENCES SOCIALES</strong>
                <ul id="competences">
                    <li>Sens de l'organisation</li>
                    <li>Confortable avec le public</li>
                    <li>Facilité d'approche</li>
                    <li>Capacité d'analyse et bon jugement</li>
                    <li>Ouvert d'esprit</li>
                    <li>Débrouillard et fiable</li>
                    <li>Autonome - Rigoureux</li>
                    <li>Compétitif</li>
                    <li>À l'aise dans les domaines de la technologie</li>
                </ul><br>
            </p>
    </div>
</div>

EOT;

include("template.php");



?>