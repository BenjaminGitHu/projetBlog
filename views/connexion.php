<section>
    <div class="d-flex justify-content-center ">
        <div class="col-lg-7 col-md-6 col-12">

            <form method="POST" action="" id="form-connexion" class="corps col-lg-5 ">

                <div class="titre-form">
                    <h1 class="">Connexion</h1>
                </div>

                <?=$contenu?>
                <?=$message?>

                <label for="pseudo" class="form-label collapse">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"  value="<?php if (isset($_POST['pseudo'] )){echo $_POST['pseudo'];} ?>" class="input-form"><br>
                
                <label for="mdp" class="form-label collapse">Mot de passe</label><br>
                <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" class="input-form"><br><br>
            
                <input type="submit" value="Se connecter" id="connexion"class="btn btn-primary btn-form input-form">
   
            </form>
        </div>
    </div>
</section>

<script>
    let a = 'ttt';
    console.log(a);
    let b = document.querySelector('#connexion');
    console.log(b);



</script>