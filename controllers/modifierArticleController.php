<?php

use phpDocumentor\Reflection\Location;
    //------- On restrient l'accès aux ayant droit
    if(!estAdmin() && !estAuteur()){
        header('location:index.php?page=accueil');
        exit;
    }

    if( isset($_GET['retour']) && !empty($_GET['retour']) ){
        $cibleRetour = '&nbPage=' . $_GET['retour'];
    }else{
        $cibleRetour = '';
    }
    //------- On récupère les données de la table catégorie -> pour ensuite utiliser dans le <select>
    $tableCategorie = new categorie;
    $dataTableCategorie = $tableCategorie -> lireTout();


    //------- Procéder à la modification
    if(isset($_GET['id_article']) && !empty($_GET['id_article'])){    //------- Si on a bien in id_article en parametre (un article)
        $article = new article;
        $article -> setIdArticle($_GET['id_article']);
        $dataArticleAModif = $article -> lireUnArticle();     //------- On récupère les données liées à cette article

        $cat = new categorie;
        $cat -> setIdCategorie($dataArticleAModif['id_categorie']);
        $dataCategorie = $cat -> lireUne();
        
        //------- Initialisation des variables avec les données de l'article existant
        $nomCategorie = $dataCategorie['nomCategorie'];
        $valueTitre =$dataArticleAModif['titre'];
        $valueContenu = $dataArticleAModif['contenu'];
        $valueIdCategorie = $dataArticleAModif['id_categorie'];
        $valueFile = basename($dataArticleAModif['image']);
        $afficheNomFile = $dataArticleAModif['image'];

        if(!empty($_POST)){     //------- On test les données de $_POST
            if (!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 255){
                $contenu1 .= '<div class="alerte-erreur"> Le titre doit contenir au minimum 2 caractères. </div>';
            }
            if (!isset($_POST['contenu']) || strlen($_POST['contenu']) < 2 || strlen($_POST['contenu']) > 50000){
                $contenu2 .= '<div class="alerte-erreur"> Le contenu de l\'article doit contenir au minimum 2 caractères. </div>';
            }
            if (!isset($_POST['id_categorie']) || $_POST['id_categorie'] == ''){
                $contenu3 .= '<div class="alerte-erreur"> Vous n\'avez pas choisit de catégorie. </div>';
            }
            if (!isset($_FILES['image']['name']) || strlen($_FILES['image']['name']) < 5 || strlen($_FILES['image']['name']) > 300){

                $contenu4 .= '<div class="alerte-erreur">Le nom de l\'image doit contenir entre 5 et 99 caractères. </div>';
            }
            if (empty($contenu) && empty($contenu1) && empty($contenu2) && empty($contenu3) && empty($contenu4)){  //------- Si pas d'erreurs alors on peut modifier
                if( !empty($_FILES['image']['name']) ){     //------- On vérifie 
                    $nouvelleImage = new image($_FILES['image']['name']);
                    if( $nouvelleImage -> estImage()){
                        $nouvelleImage -> getNomUnique();
                        $cheminAccesImage = $nouvelleImage -> getCheminAcces();
                        $article -> setImage($cheminAccesImage);
                    }else{
                        $contenu4 .= '<div class="alerte-erreur">Le Fichier n\'est pas une image. L\'image n\'a pas été modifiée.  </div>';
                    }
                }
            }
            $article -> setByArray($_POST);
            $succes = $article -> updateArticle();
            if($succes){
                 $contenu = '<div class="alerte-succes">L\'article a été modifié. <a href="index.php?page=voirArticle&id_article='. $_GET['id_article'] . '">Voir l\'article.<a/></div>';
                 //------ Initialisation des nouvelles valeurs des attributs "value"
                //------ input titre
                    $valueTitre = $_POST['titre'];
                //------ textarea
                    $valueContenu = $_POST['contenu'];
                //------ select 
                    $valueIdCategorie = $_POST['id_categorie'];
                    $cat = new categorie;
                    $cat -> setIdCategorie($_POST['id_categorie']);
                    $dataCategorieUne = $cat -> lireUne();
                    $nomCategorie = $dataCategorieUne['nomCategorie'];
                //------ input file
                    $valueFile = $_FILES['image']['name'];
                    $afficheNomFile = '<img src="'.$_FILES['image']['name'].'" alt="" >';
            }else{
                $contenu .= '<div class="alerte-erreur">L\'article n\'a pas été modifié. </div>';
            }
        } 
    }

    include_once 'layouts/layout.php';
?>
