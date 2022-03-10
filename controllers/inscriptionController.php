<?php 
    if(isset($_GET['action']) && $_GET['action'] == 'delete' && estConnecte()){
        $supUtilisateur = new utilisateur;
        $supUtilisateur -> setPseudo($_SESSION['utilisateur']['pseudo']);
        $succes = $supUtilisateur -> supprimerUtilisateur();
        header('location:index.php?page=accueil');
    }else if(estConnecte()){
        header('location:index.php&page=accueil');
        exit;
    }

    if(!empty($_POST)){ //------ Controlle si le formulaire est plein et conforme à nos contraintes
        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 50){
            $contenu1 .= '<div class="alerte-erreur"> Le nom doit contenir entre 4 et 50 caractères. </div>';
        }
        if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 50){
            $contenu2 .= '<div class="alerte-erreur"> Le prenom doit contenir entre 4 et 50 caractères. </div>';
        }
        if (!isset($_POST['email']) || strlen($_POST['email']) < 7 || strlen($_POST['email']) > 80 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $contenu3 .= '<div class="alerte-erreur"> Email non valide. </div>';
        }
        if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 50){
            $contenu4 .= '<div class="alerte-erreur"> Le pseudo doit contenir entre 4 et 50 caractères. </div>';
        }
        if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 50){
            $contenu5 .= '<div class="alerte-erreur"> Le mot de passe doit contenir entre 4 et 20 caractères. </div>';
        }
        if (empty($contenu1) && empty($contenu2) && empty($contenu3) && empty($contenu4) &&  empty($contenu5)){
            $nouvelUtilisateur = new utilisateur;
            $nouvelUtilisateur -> setUtilisateur($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['mdp'], $_POST['pseudo']);
            //------ On verifie que le mail et le pseudo sont bien unique avant d'ajouter un utilisateur.
            if($nouvelUtilisateur -> mailExiste()){
                $contenu3 .= '<div class="alerte-erreur">Cette adresse mail existe déjà. </div>';
            }
            if($nouvelUtilisateur -> pseudoExiste()){
                $contenu4 .= '<div class="alerte-erreur">Ce pseudo existe déjà. </div>';
            }
            if( empty($contenu3) && empty($contenu4) ){//------ Ajout d'un nouvelle utilisateur
                if ( ($nouvelUtilisateur -> ajouterUtilisateur()) == 1){
                    $contenu .= '<div class="alerte-succes"> Vous êtes inscrit. Connectez-vous en <a href="index.php?page=connexion"> cliquez ici </a></div>';
                }else{
                    $contenu .= '<div class="alerte-erreur"> Une erreur est survenue... </div>';
                }
            }else{
                unset($nouvelUtilisateur);
            }
        }
    }
    include_once 'layouts/layout.php';
?>
