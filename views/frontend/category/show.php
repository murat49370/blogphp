<?php $title= 'Catgory' ?>

<?php ob_start(); ?>



<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="text-center">Category title : <?= htmlentities($category->getTitle()) ?></h1>

    </div>
</header>

<section class="post-content-section">
    <div class="container">
        <div class="row">
            <h2>Liste des article lier a la cathégorie : '<?= htmlentities($category->getTitle()) ?>' - id#<?= $category->getId() ?></h2>
            <p>
                <?php
                //dd($categories);
                foreach ($categories as $k => $category): ?>
                    <a href="<?= $router->generate('post', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>"> >> <?= $category->getTitle() ?></a>
                    <br>

                <?php endforeach; ?>
            </p>






        </div>
    </div> <!-- /container -->





    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
    <div class="scroll-to-top d-lg-none position-fixed">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
    </div>



    <?php $content = ob_get_clean(); ?>
    <?php require('../views/frontend/layouts/default.php'); ?>

