<section class="container col-md-11 col-lg-7"> 
    <form method="POST" action="" enctype="multipart/form-data" id="form-creer-article">
        <div class="titre-form">
            <h1>Créer un article</h1>
        </div>
        <?=$contenu?>

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <label for="titre" class="form-label">Titre</label><br>
                <input type="text" id="titre" name="titre" class="col-lg-12 input-form" value="<?=$valueTitre?>"><br>
                <?=$contenu1?><br>

                <label for="contenu" class="form-label">Contenu de l'article</label><br>
                <textarea id="contenu" name="contenu" rows="10" class="col-lg-12 input-form" value="<?=$valueContenu?>"><?=$valueContenu?></textarea><br>
                <?=$contenu2?><br>
            </div>

            <div class="col-lg-4 col-md-12">

                <label for="idCategorie" class="form-label">Choisir une catégorie</label><br>
                <select name="idCategorie" id="idCategorie" class="input-form">
                        <option value="<?=$valueIdCategorie?>"> <?=$nomCategorie?></option>
                        <?php foreach( $dataTableCategorie as $indice => $valeur){
                            echo '<option value="'. $valeur['id_categorie'].'">'.ucfirst($valeur['nomCategorie']).'</option>';
                        }?>
                </select><br>
                <?=$contenu3?><br>

                <label for="image" class="form-label ">Ajouter une image</label><br>
                <input type="file" id="image" name="image"  size="50px" value="<?=$valueFile?>"><br>
                <?=$afficheNomFile?><br>
                <?=$contenu4?><br>

            </div>
        </div>
        <input type="submit" value="Publier l'article" class="btn btn-primary btn-form">
    </form>
</section>


<!-- 
SELECT a.id_article, c.nomCategorie FROM `article` a INNER JOIN categorie c ON a.id_categorie=c.id_categorie WHERE id_article=106; 

 -->