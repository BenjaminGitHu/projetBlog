<?php
    //------ Creer un objet article
    $art1 = new article;
    //------ Si id_article dans l'url alors supprime l'article et recharge la page 
    if(isset($_GET['id_article'])){
        $art1 -> setIdArticle(($_GET['id_article']));
        $art1 -> supprimer();
        header('location:index.php?page=accueil');
    }

    // $resolution = "<script language='Javascript'>
    // <!--
    // document.write(screen.width)
    // //-->
    // </script>"; 
    //------ Récupére la liste des categories
    $tableCategorie = new categorie;
    $dataTableCategorie = $tableCategorie -> lireTout();

    $articles = $art1 -> lireTout();

    //------ Initialisation de la pagination
    $articleParPage= 6;
    $nbArticleTotal = sizeof($articles);
    $pageTotal = ceil($nbArticleTotal/$articleParPage);

    //------ Controle de l'attribut nbPage
    if(isset($_GET['nbPage']) && !empty($_GET['nbPage']) && $_GET['nbPage'] > 0 && $_GET['nbPage'] <= $pageTotal){
        $_GET['nbPage'] = intval($_GET['nbPage']); //  intval peu retourner 0 si le parametre est un string
        $pageCourante =  $_GET['nbPage'];
    }else{
        $pageCourante = 1;
    }
    $depart = ($pageCourante -1)*$articleParPage;
    
    $art1 -> setIntervalle($depart,$articleParPage);
    $intArticle =$art1 -> intervalleArticle();

    //------ Affichage de la pagination 
        $contenu .= '<a href="';
            if( $pageCourante > 1 ){$contenu .= 'index.php?page=accueil&nbPage=' . $pageCourante-1;}else{$contenu .= '#';}
        $contenu .= ' " class="pagination-lien"> << </a>'; 
        if( $pageTotal > 4 ){
            if($pageCourante != $pageTotal){
                if( $pageCourante == 1){
                    $contenu .= '<a href="index.php?page=accueil&nbPage='. $pageCourante  .'" class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">'. $pageCourante  .'</a>';
                    $contenu .= '<a href="index.php?page=accueil&nbPage=' .  $pageCourante+1 . '" class="pagination-lien">'.  $pageCourante+1 . '</a>';  
                    $contenu .= ' <a href="#" class="pagination-lien"> ... </a>';  
                }
                else if( $pageCourante == 2){
                    $contenu .= '<a href="index.php?page=accueil&nbPage=1" class="pagination-lien">1</a>';
                    $contenu .= '<a href="index.php?page=accueil&nbPage='. $pageCourante  .'" class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">'. $pageCourante  .'</a>';   
                    $contenu .= '<a href="#" class="pagination-lien"> ... </a>'; 
                }            
                else if( $pageCourante == $pageTotal-1){
                    $contenu .= '<a href="index.php?page=accueil&nbPage=1" class="pagination-lien">1</a>';
                    $contenu .= '<a href="#" class="pagination-lien"> ... </a>';
                    $contenu .= '<a href="index.php?page=accueil&nbPage='. $pageCourante  .'" class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">'. $pageCourante  .'</a>';    
                }
                else{
                    $contenu .= '<a href="index.php?page=accueil&nbPage=1" class="pagination-lien">1</a>';
                    $contenu .= '<a href="#" class="pagination-lien"> ... </a>
                                <a href="index.php?page=accueil&nbPage='. $pageCourante  .'" class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">'. $pageCourante  .'</a>
                                <a href="#" class="pagination-lien"> ... </a>';   
                      
                }
                $contenu .= '<a href="index.php?page=accueil&nbPage=' . $pageTotal . '" class="pagination-lien">'. $pageTotal . '</a>';
            }
            else if( $pageCourante == $pageTotal){
                    $contenu .= '<a href="index.php?page=accueil&nbPage=1" class="pagination-lien">1</a>';
                    $contenu .= '<a href="#" class="pagination-lien"> ... </a>';
                    $contenu .= '<a href="index.php?page=accueil&nbPage='. $pageCourante-1  .'" class="pagination-lien">'. $pageCourante-1  .'</a>'; 
                    $contenu .= '<a href="index.php?page=accueil&nbPage='. $pageCourante  .'" class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">'. $pageCourante  .'</a>';   
            }
        }
        else{
            for($i=1; $i <= $pageTotal; $i++){
                if($pageCourante == $i  ){
                    $contenu .= '<a href="index.php?page=accueil&nbPage=' . $i . ' " class="pagination-lien" style="border-color: rgb(4, 85, 160);color:rgb(4, 85, 160);font-weight:bold;">' . $i . "</a> ";
                }else{
                    $contenu .= '<a href="index.php?page=accueil&nbPage=' . $i . ' " class="pagination-lien">' . $i . '</a>';   
                }
            }
        }
        $contenu .= '<a href="';
            if($pageCourante == $pageTotal){$contenu .= '#';}else{$contenu .= 'index.php?page=accueil&nbPage=' . $pageCourante+1;}
        $contenu .= ' " class="pagination-lien"> >> </a>';
    

    include_once 'layouts/layout.php';
?>

