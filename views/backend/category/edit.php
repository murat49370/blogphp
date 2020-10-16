
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un Commentaire</h1>
</header>
<div class="container">
    <?php if ($success):  ?>
        <div class="alert alert-success">
            La category a bien été modifié
        </div>
    <?php endif ?>

<!-- Posts Section-->
<section class="page-section posts" id="posts">

        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification de la catégorie id N° <?= $category->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->

        <form action="" method="post">
            <div class="form-group">
                <label for="title">Titre : </label>
                <input type="text" class="form-control" name="title" value="<?= $category->getTitle() ?>"><br>
            </div>
            <div class="form-group">
                <label for="title">Slug : </label>
                <input type="text" class="form-control" name="slug" value="<?= $category->getSlug() ?>"><br>
            </div>

            <button class="btn-primary">Validé les modifications</button>
        </form>


</div>
</section>



<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>

