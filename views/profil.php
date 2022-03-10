<section class="container col-md-11 col-lg-7">
    <div class="corps">
    <h1 class="titre-page"><?=$_SESSION['utilisateur']['pseudo']?></h1>
    <div class="p-3">
        <div class="">
            <h2>Identité</h2>
            <p class="keep-space">Nom:         <?=$dataUtilisateur['nom']?></p>
            <p class="keep-space">Prénom:   <?=$dataUtilisateur['prenom']?></p>
            <p class="keep-space">Email:        <?=$dataUtilisateur['email']?></p>
            <hr>
        </div>        
        <div class="">
            <h2>Récapitulatif</h2>
            <p>Vous etes un <?= $dataUtilisateur['role']?> du blog.</p>
            <hr>
        </div> 
        <div class="">
            <h2>Compte</h2>
            <p>Inscrit depuis le <?=$dataUtilisateur["DATE_FORMAT(dateInscription, '%e %b %Y' )"]?>. </p>
            <p>Changer de mot de passe</p>
            <a href="index.php?page=inscription&action=delete" class="btn btn-danger" onclick="return confirm('Etes-vous certain de vouloir supprimer votre compte?')">Supprimer</a>
        </div>
    </div>
    </div>
</section>
