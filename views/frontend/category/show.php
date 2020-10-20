<?php $title= 'Catégorie: ' .  htmlentities($category->getTitle()) ?>

<?php ob_start(); ?>

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="text-center">Liste des articles dans la catégorie : <?= htmlentities($category->getTitle()) ?></h1>
    </div>
</header>


<div class="container">
    <div class="row">
        <?php
        foreach ($categories as $k => $category)
        { ?>
            <div class="col-md-4">
                <div class="single-blog-item">
                    <div class="blog-thumnail">
                        <a href=""><img src="<?php echo $category->getSmallImage();?>" alt="blog-img"></a>
                    </div>
                    <div class="blog-content">
                        <h4><a href="#"><?php echo $category->getTitle();?></a></h4>
                        <p><?php echo $category->getShortContent();?></p>
                        <a href="<?= $router->generate('post', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>" class="more-btn">Voir l'article</a>

                    </div>
                    <span class="blog-date">Publié le <?php echo $category->getCreateDate()->format('j M Y');?></span>
                </div>
            </div>
        <?php } ?>
    </div>
</div> <!-- /container -->

<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

