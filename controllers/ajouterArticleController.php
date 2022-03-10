<?php

use phpDocumentor\Reflection\Location;
//------- On restrient l'accès aux ayant droit
    if(!estAdmin() && !estAuteur()){
        header('location:index.php?page=accueil');
        exit;
    }
//------- On récupère les données de la table catégorie -> pour ensuite utiliser dans le <select>
    $tableCategorie = new categorie;
    $dataTableCategorie = $tableCategorie -> lireTout();

    $valueTitre ='';
    $valueContenu ='';
    $valueIdCategorie = '';
    $nomCategorie ='';
    $valueFile = '';
    $afficheNomFile = '';

    
    if(!empty($_POST)){     //------- On test les données de $_POST
        if (!isset($_POST['titre']) || strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 255){
            $contenu1 .= '<div class="alerte-erreur"> Le titre doit contenir au minimum 2 caractères. </div>';
        }
        if (!isset($_POST['contenu']) || strlen($_POST['contenu']) < 2 || strlen($_POST['contenu']) > 50000){
            $contenu2 .= '<div class="alerte-erreur"> Le contenu de l\'article doit contenir au minimum 2 caractères. </div>';
        }
        if (!isset($_POST['idCategorie']) || $_POST['idCategorie'] == ''){
            $contenu3 .= '<div class="alerte-erreur"> Vous n\'avez pas choisit de catégorie. </div>';
        }
        if (!isset($_FILES['image']['name']) || strlen($_FILES['image']['name']) < 5 || strlen($_FILES['image']['name']) > 300){
            $contenu4 .= '<div class="alerte-erreur">Le nom de l\'image doit contenir entre 5 et 99 caractères. </div>';
        }
        if (empty($contenu) && empty($contenu1) && empty($contenu2) && empty($contenu3) && empty($contenu4)){       
            $imageArticle = new image($_FILES['image']['name']);
            if( $imageArticle -> estImage() ){      //------ On test que le fichier est bien une image
                $imageArticle -> getNomUnique();
                $cheminAccesImageArticle = $imageArticle -> getCheminAcces();

                $article = new article();
                //------ On set les valeurs de notre nouvel article
                $article -> setTitre($_POST['titre']);
                $article -> setContenu($_POST['contenu']);
                $article -> setImage($cheminAccesImageArticle);
                $article -> setCategorie($_POST['idCategorie']);
                $article -> setAuteur($_SESSION['utilisateur']['pseudo']);
                //------ On test si il a bien été ajouté
                if( $article ->ajouterArticle() ){
                    $contenu .= '<div class="alerte-succes"> L\'article a bien été créé.<a href="index.php?page=accueil"> Voir les derniers articles. </a></div>';
                }else{
                    $contenu4 .= '<div class="alerte-erreur"> Un problème est survenue. L\'article n\'a été créer. </div>';
                }
            }else{
                $contenu4 .= '<div class="alerte-erreur"> Le fichier n\'est pas une image. </div>';
            }
        }
        //------ Initialisation des valeur des attributs "value"
        //------ input titre
        if (isset($_POST['titre']) && empty($contenu1)){
            $valueTitre = $_POST['titre'];
        }
        //------ textarea
        if (isset($_POST['contenu']) && empty($contenu2)){
            $valueContenu = $_POST['contenu'];
        }
        //------ select 
        if (isset($_POST['idCategorie']) && empty($contenu3) && $_POST['idCategorie'] != ''){
            $valueIdCategorie = $_POST['idCategorie'];
            $cat = new categorie;
            $cat -> setIdCategorie($_POST['idCategorie']);
            $dataCategorieUne = $cat -> lireUne();
            $nomCategorie = $dataCategorieUne['nomCategorie'];
        }
        else{
            $valueIdCategorie = '';
            $nomCategorie = ' ------- Choisir une Catégorie ------ ';
        }
        //------ input file
        if (isset($_FILES['image']['name']) && empty($contenu4)){
            $valueFile = '$_FILES[\'image\'][\'name\']';
            $afficheNomFile = '<p>'.$_FILES['image']['name'].'</p>';
        }   
    }
    
    include_once 'layouts/layout.php';
?>
