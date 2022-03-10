<?php 
//------ Si non Admin -> redirige
    if(!estAdmin()){
        header('location:index.php?page=accueil');
        exit;
    }


// print_r($_POST);

    if(!empty($_POST)){
        // || $_POST['role'] != 'membre' && $_POST['role'] != 'auteur' &&  $_POST['role'] != 'administrateur'
        if (!isset($_POST['role']) ){
            $contenu .= '<div class="alert alert-danger"> Le role inconnue. </div>';
        }
        if (!isset($_POST['pseudo'])){
            $contenu .= '<div class="alert alert-danger"> Le pseudo doit contenir entre 4 et 50 caractères. </div>';
        }
        if (empty($contenu)){
            $modifierUtilisateur = new utilisateur;
            $modifierUtilisateur -> setPseudo($_POST['pseudo']);
            if($modifierUtilisateur -> lire() == 0){
                $contenu .= '<div class="alert alert-danger"> Ce pseudo n\'existe pas. </div>';
            }
            else{
                $succes = $modifierUtilisateur -> updateUtilisateur($_POST);
                if ($succes == 1){
                    $contenu .= '<div class="alert alert-success"> Les données de l\'utilisateur ont été modifiés. </div>';
                    header('location:index.php?page=utilisateur');
                }else {
                    $contenu .= '<div class="alert alert-danger"> Modification échoué! </div>';
                }
            } 
        }


        if (!isset($_POST['role']) ){
            $contenu2 .= '<div class="alert alert-danger"> Erreur choissez une catégorie. </div>';
        }echo 1;
        if( empty($contenu2) ){echo 1;
            $supCategorie = new categorie;
            $supCategorie -> setNomCategorie($_POST['role']);
            echo 1;
            if ($supCategorie -> existe() == 1){echo 1;
                if( $supCategorie -> supprimerCategorie() == 1){
                    $contenu2 .= '<div class="alert alert-success"> Catégorie supprimée. </div>';
                    header('location:index.php?page=utilisateur');
                }else{
                    $contenu2 .= '<div class="alert alert-danger"> Erreur lors de la suppression. </div>';
                }
            }else{
                $contenu2 .= '<div class="alert alert-danger"> Cette catégorie n\'existe pas. </div>';
            }
        }

        echo 1;
    }

    include_once 'layouts/layout.php';
?>