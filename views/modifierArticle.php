<section class="container col-md-11 col-lg-7"> 
    <form method="POST" action="" enctype="multipart/form-data" id="form-creer-article">
        <a href="index.php?page=accueil<?=$cibleRetour?>" class="btn btn-secondary py-0 mb-md-4 mb-5"><i class="fa-solid fa-left-long"></i></a>
        <div class="titre-form">
            <h1>Modifier l'article</h1>
        </div>
        <?=$contenu?>

        <div class="row">

            <div class="col-lg-8 col-md-12">
                <label for="titre" class="form-label">Titre</label><br>
                <input type="text" id="titre" name="titre" value="<?=$valueTitre?>" class="col-lg-12 input-form"><br>
                <?=$contenu1?><br>

                <label for="contenu" class="form-label">Contenu de l'article</label><br>
                <textarea id="contenu" name="contenu" value="<?=$valueContenu?>" rows="10" class="col-lg-12 input-form"><?=$valueContenu?></textarea><br>
                <?=$contenu2?><br>
            </div>

            <div class="col-lg-4 col-md-12">

                <label for="id_categorie" class="form-label">Choisir une catégorie</label><br>
                <select name="id_categorie" id="id_categorie" class="input-form">
                        <option value="<?=$valueIdCategorie?>"><?=$nomCategorie?></option>
                        <?php foreach( $dataTableCategorie as $indice => $valeur){
                            echo '<option value="'. $valeur['id_categorie'].'">'.ucfirst($valeur['nomCategorie']).'</option>';
                        }?>
                </select><br>
                <?=$contenu3?><br>

                <label for="image" class="form-label ">Ajouter une image</label><br>
                <input type="file" id="image" name="image" value="<?=$valueFile?>"><br>
                <p><?=$valueFile?></p>
                <?php 
                    if(!empty($dataArticleAModif['image'])){
                        echo '<img src="' . $dataArticleAModif['image'] . '" alt="" class="img-miniature-article ">';
                    }
                ?>
                <?=$contenu4?><br>

            </div>
        </div>
        <input type="submit" value="Publier l'article" class="btn btn-primary btn-form">
    </form>
</section>
