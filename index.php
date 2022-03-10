<?php 
    require_once 'inc/conf.inc.php';
    require_once 'inc/autoload.php' ;

    if( isset($_GET['page']) ){
        if( !empty($_GET['page']) ){
            $pageNameController = $_GET['page'].'Controller.php';
            $pageName = $_GET['page'].'.php';
            if( file_exists('controllers/'.$pageNameController) && file_exists('views/'.$pageName) ){
                include_once 'controllers/'.$pageNameController; 
            }
            else{
                echo '<div class="alert alert-danger">Page introuvable! </div>';
            }
        } 
    }
    else{
        $pageNameController = 'accueilController.php';
        $pageName = 'accueil.php';
        include_once 'controllers/'.$pageNameController;
        // header('location:controllers/accueilController.php');
    }

?>
