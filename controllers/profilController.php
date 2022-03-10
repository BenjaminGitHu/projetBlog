<?php
    if(!estConnecte()){
        header('location:index.php,page=accueil');
        exit;
    }

    $unUtilisateur = new utilisateur;
    $unUtilisateur -> setPseudo($_SESSION['utilisateur']['pseudo']);
    $dataUtilisateur = $unUtilisateur -> lire();
    if ($unUtilisateur -> lire() == 0){
        $contenu .= '<div class="danger alert-danger"> La récupération des données utilisateur a échouée. </div>';
    }

    include_once 'layouts/layout.php';
?>   