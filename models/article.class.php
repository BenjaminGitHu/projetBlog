<?php
    class article{
        protected $titre, $contenu, $image, $datePublication, $auteur, $categorie, $idArticle, $idCategorie;
        protected $tableau;
        protected $departInt, $nbArticle;

        //------ SETTER ------

        public function setTitre($unTitre){
            $this -> titre = htmlspecialchars($unTitre, ENT_QUOTES);
        }
        public function setContenu($unContenu){
            $this -> contenu = $unContenu;
        }
        public function setImage($uneImage){
            $this -> image = htmlspecialchars($uneImage, ENT_QUOTES);
        }
        public function setAuteur($unAuteur){
            $this -> auteur = htmlspecialchars($unAuteur, ENT_QUOTES);
        }
        public function setCategorie($uneCategorie){
            $this -> idCategorie = htmlspecialchars($uneCategorie, ENT_QUOTES);
        }
        public function setIdArticle($unId){
            $this -> idArticle = htmlspecialchars($unId, ENT_QUOTES);
        }
        public function setByArray($unTableau){
            foreach ($unTableau as $indice => $valeur){
                if($indice == 'contenu'){
                    $unTableau[$indice] = $valeur;
                }
                else{
                    $unTableau[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
                }
            }
            $tableauObject = new ArrayObject($unTableau);
            $this -> tableau = $tableauObject->getArrayCopy();
        }
        public function setNomAttribut($nomAttribut){
            $this -> nomAttribut = htmlspecialchars($nomAttribut, ENT_QUOTES);
        }
        public function setIntervalle ($unDepart, $unNbArticle){
            $this -> departInt = htmlspecialchars($unDepart, ENT_QUOTES);
            $this -> nbArticle = htmlspecialchars($unNbArticle, ENT_QUOTES);
        }
        //------ METHODE ------

        public function ajouterArticle(){
            $req = $GLOBALS['dbConnect'] -> prepare("INSERT INTO article (titre, contenu, image, auteurArticle, id_categorie) VALUES (:titre, :contenu, :image, :auteurArticle, :id_categorie)");
            $succes = $req -> execute(array(
                ':titre' => $this->titre,
                ':contenu' => $this->contenu,
                ':image' => $this->image,
                ':auteurArticle' => $this->auteur,
                ':id_categorie' => $this->idCategorie
            ));
            return $succes && (copy($_FILES['image']['tmp_name'], $this->image));
        }

        public function lireTout(){
            $req = $GLOBALS["dbConnect"] -> query("SELECT *, DATE_FORMAT(datePublication, '%e %b %Y' ) FROM article ORDER BY datePublication DESC" );
            if( $req == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                return $req->fetchAll(\PDO::FETCH_ASSOC); //transformation en liste
            }
        }

        public function lireUnArticle(){
            $req= $GLOBALS["dbConnect"] -> prepare("SELECT *, DATE_FORMAT(datePublication, '%e %b %Y' ) FROM article WHERE id_article=:id_article"); //recuperation de toutes les données d'un article filtré par son id 
            $req -> execute(array(':id_article' => $this->idArticle));
            if( $req == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                return $req->fetch(\PDO::FETCH_ASSOC); //transformation en liste
            }
        }

        public function trierParCategorie(){
            $req= $GLOBALS["dbConnect"] -> prepare("SELECT *, DATE_FORMAT(datePublication, '%e %b %Y' ) FROM article WHERE id_categorie=:valeurAttribut"); //recuperation de toutes les données d'un article filtré par son id 
            $req -> execute(array( ':valeurAttribut' => $this -> idCategorie));
            if( $req == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                return $req->fetchAll(\PDO::FETCH_ASSOC); //transformation en liste
            }
        }

        public function supprimer(){
            $cheminAccesImage = $GLOBALS["dbConnect"] -> query("SELECT image FROM article WHERE id_article=$this->idArticle");
            $a = $cheminAccesImage->fetch(\PDO::FETCH_ASSOC);
            if($cheminAccesImage == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                $req = $GLOBALS["dbConnect"] -> prepare("DELETE FROM article WHERE id_article=:id_article");
                $req -> execute(array('id_article' => $this->idArticle));
                if( $req == false){
                    $succes = '<div class="alert alert-danger">L\'article n\'a pas été supprimé. </div>';
                }else{
                    unlink($a['image']);
                    header('refresh');
                    $succes = '<div class="alert alert-succes">L\'article a été supprimé. </div>';
                }   
            }
            return $succes;
        }
            
        public function updateArticle(){
            $champsAModifier = 0;
            $ModifSucces = 0;
            $succes = true;
            if( !empty($this -> idArticle)  && !empty($this -> tableau)){
                foreach ($this -> tableau as $indice => $valeur){
                    if(isset($valeur) && !empty($valeur)){
                        $champsAModifier++;
                        $req = $GLOBALS["dbConnect"] -> query("UPDATE article SET $indice='$valeur' WHERE id_article=$this->idArticle");
                        if( $req != false){
                            $ModifSucces++;
                        }
                    }
                }
            }
            if( !empty($this -> image) ){
                $champsAModifier++;
                $req = $GLOBALS["dbConnect"] -> query("SELECT image FROM article WHERE id_article=$this->idArticle");      //recupère le chemin d'accés de l'image actuel
                if( $req != false){
                    $ancienneImage = $req -> fetch(\PDO::FETCH_ASSOC);   // Mets sous forme de tableau pour traiter la donnée.
                    if ( $GLOBALS["dbConnect"] -> query("UPDATE article SET image='$this->image' WHERE id_article=$this->idArticle") != false){       //------------modifie en BDD
                        $ModifSucces++;
                        if(!copy($_FILES['image']['tmp_name'], $this -> image)){        //tmp_name:Le nom temporaire du fichier qui sera chargé sur la machine serveur.
                            $succes = false;
                        }else{
                            unlink($ancienneImage['image']);    //------------Supprime ancienne image
                        }
                    }
                }
            }
            return $champsAModifier == $ModifSucces && $ModifSucces != 0 && $succes;
        }

        public function intervalleArticle(){
            $req = $GLOBALS["dbConnect"] -> query("SELECT *, DATE_FORMAT(datePublication, '%e %b %Y' ) FROM article ORDER BY datePublication DESC LIMIT $this->departInt , $this->nbArticle");
            if( $req == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                return $req->fetchAll(\PDO::FETCH_ASSOC); //transformation en liste
            }
        }

        public function getNomCategorie(){
            $req = $GLOBALS["dbConnect"] -> prepare("SELECT c.nomCategorie FROM `article` a INNER JOIN categorie c ON a.id_categorie=c.id_categorie WHERE id_article=:id_article");
            $req -> execute(array(
                ':id_article' => $this -> idArticle
            ));
            if( $req == false){
                exit ('<div class="alert alert-danger"> Erreur lors du traitement de la requête. </div>');
            }else{
                return $req->fetch(\PDO::FETCH_ASSOC); //transformation en liste
            }
        }
    }    
?>

