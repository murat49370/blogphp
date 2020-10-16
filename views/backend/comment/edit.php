
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un Commentaire</h1>
</header>
<div class="container">
    <?php if ($success):  ?>
        <div class="alert alert-success">
            Le commentaire a bien été modifié
        </div>
    <?php endif ?>

<!-- Posts Section-->
<section class="page-section posts" id="posts">

        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification du commentaire id N° <?= $comment->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Post id : </label>
            <input type="text" class="form-control" name="post_id" value="<?= $comment->getPostId() ?>"><br>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Author Name : </label>
                <input type="text" class="form-control" name="author_name" value="<?= $comment->getAuthorName() ?>"><br>
            </div>
            <div class="form-group">
                <label for="title">Author Email : </label>
                <input type="text" class="form-control" name="author_email" value="<?= $comment->getAuthorEmail() ?>"><br>
            </div>

            <div class="form-group">
                <label for="title">Contenue du commentaire :</label><br>
                <textarea class="form-control" name="content" id="content" rows="5" ><?= $comment->getContent() ?> </textarea><br>
            </div>

            <div class="form-check">
                <label for="title">Changer le status du commentaire :</label><br>
                <input class="form-check-input" type="checkbox" name="publish" id="publish" value="publish" checked>
                <label class="form-check-label" for="exampleRadios1">
                Publié
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="checkbox" name="waiting" id="waiting" value="waiting" >
                <label class="form-check-label" for="exampleRadios1">
                En attente de validation
                </label>
            </div>
            <div class="form-check disabled">
                <input class="form-check-input" type="checkbox" name="refused" id="refused" value="refused" >
                <label class="form-check-label" for="exampleRadios1">
                Refusé
                </label>
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

