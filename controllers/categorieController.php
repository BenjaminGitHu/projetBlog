<?php 
//------ Si non Admin -> redirige
    if(!estAdmin()){
        header('location:index.php?page=accueil');
        exit;
    }

    $tableCategorie = new categorie;
    $dataTableCategorie = $tableCategorie -> lireTout();

// print_r($_POST);

    if(!empty($_POST)){
        
        if (isset($_POST['ajouterCategorie']) && !empty($_POST['ajouterCategorie']) ){
            $nouvelleCategorie = new categorie;
            $nouvelleCategorie -> setNomCategorie($_POST['ajouterCategorie']);
            if ($nouvelleCategorie -> existe() == 1){
                $contenu1 .= '<div class="alert alert-danger"> Cette catégorie éxiste déjà. </div>';
            }else{
                if($nouvelleCategorie -> ajouterCategorie() == 1){
                    $contenu1 .= '<div class="alert alert-success"> Catégorie ajoutée. </div>';

                    // header('location:index.php?page=categorie');
                }
                else{
                    $contenu1 .= '<div class="alert alert-danger"> Erreur lors de l\'ajout de la catégorie. </div>';
                }
            }
        }

        if ( isset($_POST['nomCategorieSup']) && !empty($_POST['nomCategorieSup']) ){
            $supCategorie = new categorie;
            $supCategorie -> setNomCategorie($_POST['nomCategorieSup']);
            if ($supCategorie -> existe() == 1){
                if( $supCategorie -> supprimerCategorie() == 1){
                    $contenu2 .= '<div class="alert alert-success"> Catégorie supprimée. </div>';
                    // header('location:index.php?page=categorie');
                }else{
                    $contenu2 .= '<div class="alert alert-danger"> Erreur lors de la suppression. </div>';
                }
            }else{
                $contenu2 .= '<div class="alert alert-danger"> Cette catégorie n\'existe pas. </div>';
            }
        }
    }

    include_once 'layouts/layout.php';
?>