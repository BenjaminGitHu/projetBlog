<?php
    class image{
        protected $nomImage, $nomImageUnique;

        public function __construct($unNomImage){
            $this -> nomImage = htmlspecialchars($unNomImage);
        }

        public function estImage(){
            $info = new  SplFileInfo($this->nomImage);
            $extension = $info -> getExtension();
            return $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png'|| $extension == 'PNG';
        }

        public function getNomUnique(){
            $info = new SplFileInfo($this->nomImage);       //fournit une interface avec les informations de fichiers. 
            $extension = $info -> getExtension();
            $tailleExtension = -(strlen($extension)+1);
            $nomImageSansExtension = substr($this->nomImage, 0, $tailleExtension);      //récupère nom fichier sans '.extension'
            $this->nomImageUnique = uniqid($nomImageSansExtension . '_', false) . '.' . $extension;     //Reconcstruit un nom fichier unique en ajoutant time() ??returne de tout?? htmlspe
            return $this->nomImageUnique;
        }
        public function getCheminAcces(){
            if(empty($this->nomImageUnique)){
                exit("<div> getNomUnique() doit etre executé avant l'execution de getCheminAcces().  </div>");
            }else{
                return 'public/image/article/' . $this->nomImageUnique;
            }
        }

    }
?>