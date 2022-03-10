<section class="container col-md-11 col-lg-7">

    <?= $contenu?>
    <form method="POST" action=""  class="corps mb-4">
        <div class="titre-form">
            <h1>Utilisateur</h1>
        </div>

        <h2>Rôles utilisateur</h2>
        <div class="row col-sm-12 col-md-12">
            <div class="col-sm-12 col-md-6 ">
                <label for="pseudo" class="form-label">Désigner un utilisateur:</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo" class="input-form">
            </div>
            <div class="col-sm-12 col-md-6">
                <label for="role" class="form-label">Choisir un rôle à attribuer</label>
                <select name="role" id="role" class="input-form">
                    <option value="membre">Membre</option>
                    <option value="auteur">Auteur</option>
                    <option value="administrateur">Administrateur</option>
                </select>
            </div>
        </div>
        <div class="col">
            <input type="submit" value="Modifier" class="btn btn-primary btn-form">
        </div>    

    
    </form>
</section>