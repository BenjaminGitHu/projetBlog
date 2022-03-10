<section>
    <div class="d-flex justify-content-center ">
        <div class="col-lg-7 col-md-6 col-12">
            
            <form method="POST" action=""  class="corps col-lg-5 ">
                <div class="titre-form">
                    <h1>Inscription</h1>
                </div>
                <?=$contenu?>
                <label for="nom" class="form-label collapse">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Nom" class="input-form" value="<?php if (isset($_POST['nom']) && empty($contenu1)){echo $_POST['nom'];}?>"><br>
                <?=$contenu1?>
                <br>

                <label for="prenom" class="form-label collapse">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" class="input-form" value="<?php if (isset($_POST['prenom']) && empty($contenu2)){echo $_POST['prenom'];}?>"><br>
                <?=$contenu2?>
                <br>

                <label for="email" class="form-label collapse">Email</label>
                <input type="mail" id="email" name="email" placeholder="exemple@gmail.com" class="input-form" value="<?php if (isset($_POST['email']) && empty($contenu3)){echo $_POST['email'];}?>"><br>
                <?=$contenu3?>
                <br>

                <label for="pseudo" class="form-label collapse">Pseudo</label>
                <input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Pseudo" pattern="[a-zA-Z0-9-_.]{1,20}" title="caractères acceptés : a-zA-Z0-9-_." class="input-form" value="<?php if (isset($_POST['pseudo']) && empty($contenu4)){echo $_POST['pseudo'];}?>"><br>
                <?=$contenu4?>
                <br>

                <label for="mdp" class="form-label collapse">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" class="input-form"value="<?php if (isset($_POST['mdp']) && empty($contenu5)){echo $_POST['mdp'];}?>"><br>
                <?=$contenu5?>
                <br>

                <input type="submit" value="S'inscrire" class="btn btn-primary btn-form input-form">
            </form>

        </div>
    </div>
</section>