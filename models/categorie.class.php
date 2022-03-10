<?php 
    class categorie{
        private $nomCategorie, $idCategorie;

        //------ SETTER ------
        public function setNomCategorie($unNom){
            $this -> nomCategorie = htmlspecialchars($unNom, ENT_QUOTES);
        }
        public function setIdCategorie($unId){
            $this -> idCategorie = htmlspecialchars($unId, ENT_QUOTES);
        }
        //------ GETTER ------
        public function getNomCategorie(){
            return $this->nomCategorie;
        }
        public function getIdCategorie(){
            return $this -> idCategorie;
        }
        //------ METHODE     ------
        public function lireTout(){
            $CategorieTout = $GLOBALS["dbConnect"] -> query('SELECT * FROM categorie'); //------ Prepare puis execute la requête -> Recuperation de toutes les données de la table role
            return $CategorieTout -> fetchAll(\PDO::FETCH_ASSOC); //------ Transformation en liste dans un tableau qui aura pour indice l'attribut de la colonne de la table.
        }
        public function lireUne(){
            $CategorieUne = $GLOBALS["dbConnect"] -> prepare('SELECT * FROM categorie WHERE id_categorie=:id_categorie'); //------ Prepare puis execute la requête -> Recuperation de toutes les données de la table role
            $resultat = $CategorieUne -> execute(array('id_categorie' => $this -> idCategorie));
            return   $CategorieUne-> fetch(\PDO::FETCH_ASSOC); //------ Transformation en liste dans un tableau qui aura pour indice l'attribut de la colonne de la table.
        }

        public function existe(){
            $req = $GLOBALS["dbConnect"] -> prepare("SELECT * FROM categorie WHERE nomCategorie=:nomCategorie");
            $nomCat = $this->getNomCategorie();
            $req -> execute(array(
                ':nomCategorie' => $nomCat
            ));
            if ($req -> rowcount() > 0){
                $succes = 1;
            }else{
                $succes = 0;
            }
            return $succes;
        }

        function ajouterCategorie(){
            $nomCat = $this -> getNomCategorie();
            $req = $GLOBALS["dbConnect"] -> prepare("INSERT INTO categorie (nomCategorie) VALUES (:nom)");
            $req -> execute(array(
                ':nom'         => $nomCat
            ));
            if ($req -> rowcount() == 1){    //------ On verifie que la requête a bien été executé. Si elle a agit sur ligne, alors succes.
                $succes = 1;
            }else{
                $succes = 0;
            }
            return $succes;
        }

        function supprimerCategorie(){
            $req = $GLOBALS["dbConnect"] -> prepare("DELETE FROM categorie WHERE nomCategorie=:nomCategorie");
            $req -> execute(array(':nomCategorie' => $this->nomCategorie));     //------ On lie la variable par la fonction execute() et un tableau de donnée. 
            $nbLigneModifie = $req -> rowcount();
            if($nbLigneModifie == 1){
                $succes = 1;
            }else{
                $succes = 0;
            }
            return $succes;
        }
        // public function lire(){
        //     $unUtilisateur = $GLOBALS["dbConnect"] -> prepare("SELECT *, DATE_FORMAT(dateInscription, '%e %b %Y' ) FROM utilisateur WHERE pseudo=:pseudo"); //recuperation de toutes les données d'un article filtré par son id 
        //     $unUtilisateur -> execute(array(':pseudo' => $this->pseudo));
        //     if($unUtilisateur -> rowcount() == 1){
        //         $succes = $unUtilisateur -> fetch(\PDO::FETCH_ASSOC); //transformation les donnée en tableau  FETCH_ASSOC index le tableau avec nos resulats
        //     }else{
        //         $succes = 0;
        //     }
        //     return $succes;
        // }
    }
?>