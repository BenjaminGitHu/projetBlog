
<?php
    if(estAdmin()){?>
        <section class="pt-5">
                <div class="row gx-0 gx-md-3 col-lg-6 m-auto">
                    <div class=" col-md-9 col-lg-9 col-12 m-auto">
    <?php
    for ($i = 0; $i < sizeof($intArticle); $i++) {
        $article = $intArticle[$i];

        $art1 -> setIdArticle($article['id_article']);
        $nomCategorie = $art1 -> getNomCategorie();
        ?>
        <div class="card p-3 mb-3  col-md-12 p-md-3 col-lg-12    article-liste" >
            <div class="row  gx-0">
                <div class="col-sm-6 col-md-8 col-lg-9  ">
                    <div class="card-body p-0 pe-md-2" >
                        <h5 class="card-title  mb-1  mb-lg-2" title="<?=$article['titre']?>"> 
                        <?php
                            if (strlen($article['titre']) > 40){
                                echo strip_tags(substr($article['titre'], 0, 40)).'...';
                            }else{
                                echo strip_tags($article['titre']);
                        }?>
                        </h5>
                        <div class="row  gx-0">
                            <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><i class="fa-regular fa-calendar"> </i> <?=   $article["DATE_FORMAT(datePublication, '%e %b %Y' )"]?></p>
                            <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><?='<i class="fa-regular fa-pen-to-square"> </i>  ' .  $article['auteurArticle']?></p>
                            <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><?='<i class="fa-regular fa-bookmark"> </i>' . ' '.$nomCategorie['nomCategorie'] ?></p>
                        </div>
                        <p class="card-text mb-2 mb-md-0 "><?php 
                            if (strlen($article['contenu']) > 150){
                                echo strip_tags(substr($article['contenu'], 0, 150)).'...';
                            }else{
                                echo strip_tags($article['contenu']);
                            }?>
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 p-sm-3   col-md-4 p-md-0  col-lg-3" >
                    <img src="<?= $article['image']?>" class="img-miniature-article "  alt="">
                </div>
            </div>
            <div class="mt-2" style="display: inline !important;">
                <a href="index.php?page=voirArticle&id_article=<?= $article['id_article']?>" class="btn btn-primary sty">Lire la suite</a>
                <?php if(isset($_GET['nbPage'])){
                    $valeurRetour = '&retour=' . $_GET['nbPage'];
                }else{
                    $valeurRetour = '';
                }?>
                <a href="index.php?page=modifierArticle&id_article=<?= $article['id_article'] . $valeurRetour ?>" class="btn btn-secondary ">Modifier</a>
                <a href="index.php?page=accueil&id_article=<?= $article['id_article']?>&image=<?= $article['image']?>" class="btn btn-secondary "  onclick="return confirm('Etes-vous certain de vouloir supprimer cet article?')">Supprimer</a>
            </div>
        </div>
    <?php }?>
    <!-------- div pagination --------->
    <div class="pagination-coprs  mb-3 mx-auto col-md-10  col-lg-12">
        <div class="col-6 mx-auto d-flex justify-content-center">
            <?=$contenu?>
        </div>
    </div>
    </div>
        <aside class="col-md-3 mx-md-auto col-lg-3"> 
            <div class="widget ">
                <h4 class="titre-widget">Catégorie</h4> 
                <?php foreach( $dataTableCategorie as $indice => $valeur){
                                echo '<a href="#" class="lien-widget">'. ucfirst($valeur['nomCategorie']).'</a><br>';
                        }?>
            </div> 
        </aside>
    </div> 
</section>

    <?php
    }else{
        echo '<section class="pt-5">
                <div class="row gx-0 gx-md-3 col-lg-6 m-auto">
                    <div class="col-md-9 col-lg-9 col-12 m-auto">';
        // echo $contenu ;
        for ($i = 0; $i < sizeof($intArticle); $i++) {
            $article = $intArticle[$i];

            $art1 -> setIdArticle($article['id_article']);
            $nomCategorie = $art1 -> getNomCategorie();
    ?>
            <div class="card p-3 mb-3  col-md-12 p-md-3 col-lg-12    article-liste" >
            <div class="row  gx-0">
                <div class="col-sm-6 col-md-8 col-lg-9  ">
                    <div class="card-body p-0 pe-md-2" >
                            <h5 class="card-title  mb-1  mb-lg-2" title="<?=$article['titre']?>"><?php
                                if (strlen($article['titre']) > 40){
                                    echo strip_tags(substr($article['titre'], 0, 40)).'...';
                                }else{
                                    echo strip_tags($article['titre']);
                                }?>
                            </h5>
                            <div class="row  gx-0">
                                <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><i class="fa-regular fa-calendar"> </i> <?=   $article["DATE_FORMAT(datePublication, '%e %b %Y' )"]?></p>
                                <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><?='<i class="fa-regular fa-pen-to-square"> </i>  ' .  $article['auteurArticle']?></p>
                                <p class="meta-donnee mb-1 mb-lg-2 col col-md-4 col-lg-3"><?='<i class="fa-regular fa-bookmark"> </i>' . ' '.$nomCategorie['nomCategorie'] ?></p>
                            </div>
                            <p class="card-text mb-2 mb-md-0 "><?php 
                                if (strlen($article['contenu']) > 150){
                                    echo strip_tags(substr($article['contenu'], 0, 150)).'...';
                                }else{
                                    echo strip_tags($article['contenu']);
                                }?>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-sm-3   col-md-4 p-md-0  col-lg-3" >
                        <img src="<?= $article['image']?>" class="img-miniature-article "  alt="">
                    </div>
                </div>
                <div class="mt-2" style="display: inline !important;">
                    <a href="index.php?page=voirArticle&id_article=<?= $article['id_article']?>" class="btn btn-primary">Lire la suite</a>
                </div>              
            </div>
        <?php } ?>
    <!-------- div pagination --------->
    <div class="pagination-coprs  mb-3 mx-auto col-md-10  col-lg-12">
        <div class="col-6 mx-auto d-flex justify-content-center">
            <?=$contenu?>
        </div>
    </div>
    </div>
        <aside class="col-md-3 mx-md-auto col-lg-3"> 
            <div class="widget ">
                <h4 class="titre-widget">Catégorie</h4> 
                <?php foreach( $dataTableCategorie as $indice => $valeur){
                                echo '<a href="#" class="lien-widget">'. ucfirst($valeur['nomCategorie']).'</a><br>';
                        }?>
            </div> 
        </aside>
    </div>
</section>
<?php } ?>

