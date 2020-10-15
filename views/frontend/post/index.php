<?php $title= $post->getTitle(); ?>

<?php ob_start(); ?>



<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="text-center"><?= htmlentities($post->getTitle()) ?></h1>
        <p>Par Admin |Dans Morbi leo risus | Le <?php echo $post->getCreateDate()->format('d F Y');?></p>
        <p>Categories :
        <?php
        //dd($categories);
        foreach ($categories as $k => $category): ?>
            <?php if($k > 0): ?>
                ,
            <?php endif;?>

            <a href="<?= $router->generate('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>" class="text-light"> <?= $category->getTitle() ?></a>

        <?php endforeach; ?>
        </p>
    </div>
</header>

<section class="post-content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="image-block">
                    <img src="<?= $post->getMainImage() ?>"  alt="Main image" />
                </div>
                <p><?= nl2br(htmlentities($post->getContent())) ?></p>
            </div>

<!-- Side Barre-->
            <div class="col-lg-3  col-md-3 col-sm-12">
                <div class="well">

                    <h2>Catégories liste</h2>
                    <ul class="list-group">

                        <?php

                        foreach ($categoriesListing as $category)
                        { ?>
                            <?php $url = $router->generate('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);?>

                            <li class="list-group-item"><a href="<?= $url ?>"><?= $category->getTitle() ?></a></li>

                        <?php } ?>

                    </ul>
                </div>
            </div>

        </div>
    </div> <!-- /container -->





<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>



<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

