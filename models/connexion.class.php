<?php 
    class connexion{
        public $bdd;
        public $pseudo;
        public $motDePasse;
        public function __construct($unPseudo, $unMotDePasse){
            $this -> pseudo = $unPseudo;
            $this -> motDePasse = $unMotDePasse;
        }

        function seConnecter(){
            $req = $GLOBALS["dbConnect"] -> prepare("SELECT *, DATE_FORMAT(dateInscription, '%e %b %Y' ) FROM utilisateur WHERE pseudo='$this->pseudo'");
            $req -> execute();
            // print_r($req);
            $succes = 0;
            if($req -> rowcount() == 1){
                $utilisateur = $req ->fetch(PDO::FETCH_ASSOC);
                // echo '<br>'; print_r($utilisateur);
                if(password_verify($this->motDePasse, $utilisateur['motDePasse'])){
                    // if(empty($_SESSION)){
                    //     session_start(); 
                    
                    $_SESSION['utilisateur']=$utilisateur;echo 3;
                    $succes = 1;
                }
            }
            return $succes;
        }
    
    }
?>