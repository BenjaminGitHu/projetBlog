<section class="container col-md-11 col-lg-7">

    <?= $contenu?>
    <form method="POST" action="" class="corps mb-4">
        <div class="titre-form">
            <h1>Catégories</h1>
        </div>
        <?= $contenu1?>          
        <div class="row">
            <div class="col-lg-6">
                <label for="ajouterCategorie" class="form-label">Ajouter une catégorie</label>
                <input type="text" name="ajouterCategorie" id="ajouterCategorie" placeholder="Nommer une catégorie" class="input-form">
            </div>
            <div>
                <input type="submit" value="Ajouter" class="btn btn-primary btn-form">
            </div>
        </div><br>  

        <div class="row">
            <div class="col-lg-6">
                <label for="nomCategorieModif" class="form-label">Renommer une catégorie</label>
                <input type="text" name="nomCategorieModif" id="nomCategorieModif" placeholder="Renommer une catégorie" class="input-form">
            </div>
            <div>
                <input type="submit" value="Ajouter" class="btn btn-primary btn-form">
            </div>
        </div><br> 

        <?= $contenu2?>          
        <div class="row">    
            <div class="col-lg-6">
                <label for="nomCategorieSup" class="form-label">Supprimer une catégorie</label>
                <select name="nomCategorieSup" id="nomCategorieSup" class="input-form">
                    <option value="">------ Choisir une categorie ------</option>
                    <?php foreach( $dataTableCategorie as $indice => $valeur){
                        echo '<option value="'. $valeur['nomCategorie'].'">'.ucfirst($valeur['nomCategorie']).'</option>';
                    }?>
                </select>
            </div>
            <div>
                <input type="submit" value="Supprimer" class="btn btn-danger btn-form" onclick="return confirm('Etes-vous certain de vouloir supprimer cette categorie?')">
            </div>
        </div><br> 
    </form>
</section>