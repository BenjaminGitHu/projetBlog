<?php 
    // function renommeImage($nomFichier){
    //     $info = new SplFileInfo($nomFichier);//fournit une interface avec les informations de fichiers. 
    //     $extension = $info -> getExtension();
    //     if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'){
    //         $tailleExtension = strlen($extension);
    //         $tailleExtensionNegative = -($tailleExtension)-1;//on passe en négatif la taille de la chaine de caractère et -1 pour décalé/prendre en compte le point
    //         $nomFichierTmp = substr($nomFichier, 0, $tailleExtensionNegative);//récupère nom fichier sans '.extension'
    //         return $nomFichierTmp . '_' . time() . '.' . $extension;//Reconcstruit un nom fichier unique en ajoutant time()
    //     }else{ 
    //         return '0';
    //     }
    // }
    // function creerCheminAccesImage($nomImage){
    //     $imageBdd = 'public/image/' . $nomImage;
    //     return $imageBdd;
    // }



    function estConnecte(){
        return isset($_SESSION['utilisateur']);
    }
    function estAdmin(){
        return  (estConnecte() && $_SESSION['utilisateur']['role'] == 'administrateur');
    }
    function estAuteur(){
        return  (estConnecte() && $_SESSION['utilisateur']['role'] == 'auteur');
    }
?>