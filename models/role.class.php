<?php 
    class role{
        private $nomRole, $idRole;

        //------ SETTER ------
        public function setNomRole($unNom){
            $this -> nomRole = htmlspecialchars($unNom);
        }
        public function setIdRole($unId){
            $this -> idRole = htmlspecialchars($unId);
        }
        //------ GETTER ------
        public function getNomRole(){
            return $this -> nomRole;
        }
        public function getIdRole(){
            return $this -> idRole;
        }
        //------ METHODE     ------
        public function lireTout(){
            $roleTout = $GLOBALS["dbConnect"] -> query('SELECT * FROM role'); //------ Prepare puis execute la requête -> Recuperation de toutes les données de la table role
            return $roleTout -> fetchAll(\PDO::FETCH_ASSOC); //------ Transformation en liste dans un tableau qui aura pour indice l'attribut de la colonne de la table.
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