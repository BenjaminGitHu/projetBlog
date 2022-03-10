<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DéclikPoker</title>
        <link rel="stylesheet" href="public/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/bfac17fd11.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light ">
                <div class="container ">
                    <a class="navbar-brand" href="index.php?page=accueil">Accueil</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse  " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php 
                        if( estAuteur() || estAdmin() ){
                            echo '<li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php?page=ajouterArticle">Créer Article</a>
                                </li>';
                        }
                        if( estAdmin()){
                            echo '<ul class="navbar-nav mb-2 mb-lg-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Administration
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="index.php?page=#">Articles</a></li>
                                            <li><a class="dropdown-item" href="index.php?page=categorie">Catégories</a></li>
                                            <li><a class="dropdown-item" href="index.php?page=utilisateur">Utilisateurs</a></li>
                                        </ul>
                                    </li>
                                </ul>';
                        }
                        ?>
                    </ul>
                    <?php 
                    if(!estConnecte()){
                        echo '<ul class="navbar-nav mb-2 mb-lg-0 d-flex">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php?page=inscription">S\'incrire</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php?page=connexion">Connexion</a>
                                </li>
                            </ul>';
                    }else {
                        echo '<ul class="navbar-nav mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Compte
                                    </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="index.php?page=profil">Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="index.php?page=connexion&action=logout">Se déconnecter</a></li>
                                </ul>
                                </li>
                            </ul>';
                    }?>
                    </div>
                </div>
            </nav>
        </header>
        <main class="container-fluid">
        <?php
        include_once 'views/'.$pageName;
        ?>
        </main>
        <footer>
            <div class="container d-flex justify-content-center">    
                    <?php echo date('Y'); ?> - Tous droits reservés - Gomes Benjamin
            </div>
        </footer>
        <script src="public/javascript/accueil.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>