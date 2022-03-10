<?php
    class utilisateur{
        protected $nom, $prenom, $email, $motDePasse, $peudo;
        protected $nomAttribut, $attribut;
        //------ SETTER ------
        public function setAttribut($unAttribut){
            $this -> attribut = htmlspecialchars($unAttribut, ENT_QUOTES);
        }
        public function setNomAttribut($unNomAttribut){
            $this -> nomAttribut = htmlspecialchars($unNomAttribut, ENT_QUOTES);
        }
        public function setNom($unNom){
            $this -> nom    = htmlspecialchars($unNom);
        }
        public function setPrenom($unPrenom){
            $this -> prenom = htmlspecialchars($unPrenom);
        }
        public function setEmail($unEmail){
            $this -> email = htmlspecialchars($unEmail);
        }
        public function setMotDePasse($unMotDePasse){
            $this -> motDePasse = $unMotDePasse;
        }
        public function setPseudo($unPseudo){
            $this -> pseudo = htmlspecialchars($unPseudo);
        }
        public function setUtilisateur($unNom, $unPrenom, $unEmail, $unMotDePasse, $unPseudo){
            $this -> setNom($unNom);
            $this -> setPrenom($unPrenom);
            $this -> setEmail($unEmail);
            $this -> setMotDePasse($unMotDePasse);
            $this -> setPseudo($unPseudo);
        }
        //------ METHODE ------
        public function lireTout(){
            $utilisateurTout = $GLOBALS["dbConnect"] -> query('SELECT * FROM utilisateur'); //------ Prepare puis execute la requête -> Recuperation de toutes les données de la table utilisateur
            return $utilisateurTout -> fetchAll(\PDO::FETCH_ASSOC); //------ Transformation en liste dans un tableau qui aura pour indice l'attribut de la colonne de la table.
        }

        public function lire(){
            $unUtilisateur = $GLOBALS["dbConnect"] -> prepare("SELECT *, DATE_FORMAT(dateInscription, '%e %b %Y' ) FROM utilisateur WHERE pseudo=:pseudo"); //recuperation de toutes les données d'un article filtré par son id 
            $unUtilisateur -> execute(array(':pseudo' => $this->pseudo));
            if($unUtilisateur -> rowcount() == 1){
                $succes = $unUtilisateur -> fetch(\PDO::FETCH_ASSOC); //transformation les donnée en tableau  FETCH_ASSOC index le tableau avec nos resulats
            }else{
                $succes = 0;
            }
            return $succes;
        }

        function ajouterUtilisateur(){
            $motDePasseCrypte = password_hash($this->motDePasse, PASSWORD_DEFAULT);     //------ On encode le mot de passe avant de l'inserer en Bdd pour des raisons de sécurité
            $req = $GLOBALS["dbConnect"] -> prepare("INSERT INTO utilisateur (nom, prenom, email, motDePasse, pseudo) VALUES (:nom, :prenom, :email, :motDePasse, :pseudo)");
            $req -> execute(array(
                ':nom'         => $this->nom,
                ':prenom'      => $this->prenom,
                ':email'       => $this->email,
                ':motDePasse'  => $motDePasseCrypte,
                ':pseudo'      => $this->pseudo
            ));
            if ($req -> rowcount() == 1){    //------ On verifie que la requête a bien été executé. Si elle a agit sur ligne, alors succes.
                $succes = 1;
            }else{
                $succes = 0;
            }
            return $succes;
        }

        function supprimerUtilisateur(){
            $req = $GLOBALS["dbConnect"] -> prepare("DELETE FROM utilisateur  WHERE pseudo=:pseudo");
            $req -> execute(array(':pseudo' => $this->pseudo));     //------ On lie la variable par la fonction execute() et un tableau de donnée. 
            $nbLigneModifie = $req -> rowcount();
            if($nbLigneModifie == 1){
                session_destroy();
                header('location:index.php?page=acceuil');
            }else{
                echo '<div class="alert alert-danger">Le compte utilisateur n\'a pas été supprimé</div>';
            }
        }

        function mailExiste(){
            $succes = false;
            $req = $GLOBALS["dbConnect"] -> prepare("SELECT * FROM utilisateur WHERE email=:attribut");
            $req -> execute(array(':attribut'  =>  $this->email));
            if ($req -> rowCount() > 0){
                $succes = true;
            }
            return  $succes;       
        }

        function pseudoExiste(){
            $succes = false;
            $req = $GLOBALS["dbConnect"] -> prepare("SELECT * FROM utilisateur WHERE pseudo=:pseudo");
            $req -> bindparam(':pseudo', $this->pseudo);        //------ On lie la variable par la fonction bindparam() et un tableau de donnée. 
            $req -> execute();
            if ($req -> rowCount() > 0){
                $succes = true;
            }
            return $succes;
        }

        function updateUtilisateur($param = array()){
            $succes = 0;
            foreach($param as $indice => $valeur){
                if(isset($param[$indice]) && !empty($param[$indice])){
                    $valeurEncode = htmlspecialchars($valeur, ENT_QUOTES);
                    if($indice == 'pseudo'){
                        $nouveauPseudo = $valeur;
                    }else{                 
                        $req1 = $GLOBALS["dbConnect"] -> prepare("UPDATE utilisateur SET $indice='$valeurEncode' WHERE pseudo=:pseudo");
                        $req1 -> execute(array(
                            ':pseudo' => $this->pseudo
                        ));
                    }
                }
                if(!empty($nouveauPseudo)){
                    $req2=$GLOBALS["dbConnect"] -> prepare("UPDATE utilisateur SET pseudo=:nouveauPseudo WHERE pseudo=:pseudo");
                    $req2 -> execute(array(
                        ':nouveauPseudo'=> $nouveauPseudo,
                        ':pseudo'       => $this->pseudo
                    ));
                }
                if(isset($req1, $req2)){
                    if($req1 == true && $req2 == true){
                    $succes = 1;
                    }
                }
            }
            return $succes;  
        }

    }
?>