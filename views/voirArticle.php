<section class="container p-0  col-md-9 col-lg-6">
    <div class="corps ">
        <h1 class="titre-page"><?= $dataArticle['titre'] ?></h1>
        <div class="text-center mb-5">
                <hr>
                <p class="meta-donnee-article"><?= 'Posté le ' . $dataArticle["DATE_FORMAT(datePublication, '%e %b %Y' )"] .' par '. $dataArticle['auteurArticle'].' dans '. $nomCategorie['nomCategorie']?></p>
                <hr>
        </div>
        <article class="clearfix mx-auto mb-5">
            <img src="<?= $dataArticle['image']?>" class="img-article    col-lg-5 float-lg-end mb-3 ms-lg-3   col-md-6 float-md-end mb-3 ms-md-2   col-sm-2 float-sm-end mb-3 ms-sm-2" alt="">
            <div class=" article"><?= $dataArticle['contenu'] ?></div>
        </article>
    </div>

    <div class="corps">
        <h2 class=" mt-5">Articles similaire...</h2>
        <div class="row  ">
            <?php
                $articleALire -> setCategorie($dataArticle['id_categorie']);
                $articles = $articleALire -> trierParCategorie();

                // $articles = $articleALire -> lireTout();
                for ($i = 0; $i < 3; $i++) {
                    // $article = $articles[$i];
                    if(isset($articles[$i]) && !empty($articles[$i])){
               $articleALire -> setIdArticle($articles[$i]['id_article']);
               $nomCategorieCard = $articleALire -> getNomCategorie();
               ?>   
                <div class="col-lg-4 col-md-6 mb-4 ">
                    <div class="card card-article">
                        <img src="<?= $articles[$i]['image']?>" class="img-card" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?= substr($articles[$i]['titre'], 0, 100)?></h5>
                            <div class="row gx-0 ">
                                <p class="meta-donnee col "><i class="fa-regular fa-calendar"> </i> <?= ' '. $articles[$i]["DATE_FORMAT(datePublication, '%e %b %Y' )"] ?></p>
                                <p class="meta-donnee col "><?= ' <i class="fa-regular fa-pen-to-square"> </i> ' . $articles[$i]['auteurArticle'] ?></p>
                                <!-- <p class="meta-donnee "><?= ' <i class="fa-regular fa-bookmark"> </i> ' . $nomCategorieCard['nomCategorie'] ?></p> -->
                            </div>
                            <!-- <p class="card-text" ><?php 
                                if (strlen($articles[$i]['contenu']) > 120){
                                    echo strip_tags(substr($articles[$i]['contenu'], 0, 120)).'...';
                                }else{
                                    echo strip_tags($articles[$i]['contenu']);
                                }
                                ?>
                            </p> -->
                            <a href="index.php?page=voirArticle&id_article=<?= $articles[$i]['id_article']?>" class="btn btn-primary">Lire la suite</a>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
            ?>
        </div> 
    </div>
</section>