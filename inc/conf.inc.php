<?php
    //------- Connexion BDD
    $dbConnect= new PDO('mysql:host=localhost;dbname=declikpoker','root','',array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
    //------- Session
    session_start();

    //------- Chemin de la racine
    define('RACINE_SITE', '/php/declikPoker/');

    //------ Variables
    $contenu='';
    $contenu1='';
    $contenu2='';
    $contenu3='';
    $contenu4='';
    $contenu5='';

    //------ Inclusion
    require_once('inc/functions.php'); 

?>