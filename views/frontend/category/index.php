<?php $title= 'Category'; ?>

<?php ob_start(); ?>

<!-- Masthead-->


<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h2 class="page-section-heading text-center text-secondary mb-0">Liste des categories</h2>

    </div>
</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <!-- Posts Section Heading-->

        <br>
        <br>
        <!-- Posts Grid Items-->
        <div class="row">
            <div class="container">
                <div class="row">
                    <ul class="list-group">

                    <?php foreach ($categories as $category)
                    { ?>
                        <?php $url = $router->generate('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);?>

                        <li class="list-group-item"><a href="<?= $url ?>"><?= $category->getTitle() ?></a></li>

                    <?php } ?>
                    </ul>



                </div>
            </div>
        </div>
</section>



<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

