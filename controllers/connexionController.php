<?php     

    $message='';
    if(isset($_GET['action']) && $_GET['action'] == 'logout' ){// si "action" est dans l'URL et qu'il a pour valeur "logout" c'est que le membre
        // unset($_SESSION['utilisateur']);// on vide la session de la partie utilisateur
        session_unset();
        header('location:index.php?page=connexion');
        $message.='<div class="alerte-erreur"> Vous êtes déconnecté. </div>';
    }

    if(estConnecte()){
        header('location:index.php&page=accueil');
        exit;
    }

    
    if (!empty($_POST)){
        // Si formulaire n'est pas complet
        if(empty($_POST['pseudo']) || empty($_POST['mdp'])){
            $contenu .= '<div class="alerte-erreur text-center pb-3"> L\'un des champs est vide. </div>';
        }
        // Si il est complet, on traite les données
        if(empty($contenu)){
            $connect = new connexion($_POST['pseudo'], $_POST['mdp']);
            $resultat= $connect -> seConnecter();
            if ( $resultat == '1'){
                header('location:index.php?page=accueil');
                exit;
            }else{
             
                $contenu .= '<div class="alerte-erreur text-center pb-3"> Identifiant erroné. </div>';
            }
        }
        //  print_r($_SESSION);
    }
    include_once 'layouts/layout.php';
?>