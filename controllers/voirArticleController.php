<?php
    $articleALire = new article;
    $articleALire -> setIdArticle($_GET['id_article']);
    $nomCategorie = $articleALire -> getNomCategorie();
    $dataArticle = $articleALire -> lireUnArticle();
    include_once 'layouts/layout.php';
?>