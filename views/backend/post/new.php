
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un post</h1>
</header>
<div class="container">


    <!-- Posts Section-->
    <section class="page-section posts" id="posts">

        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification du post id N° <?= $post->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Titre : </label>
                <input type="text" class="form-control" name="title" value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Slug : </label>
                <input type="text" class="form-control" name="slug" value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Short contenue :</label><br>
                <textarea class="form-control" name="short_content" id="short_content" rows="5" ></textarea>
            </div>
            <div class="form-group">
                <label for="title">Contenue :</label><br>
                <textarea class="form-control" name="content" id="content" rows="20" ></textarea>
            </div>
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label for="title">Main image URL :</label><br>-->
<!--                    <input type="text" class="form-control" name="main_image" value="--><?//= $post->getMainImage() ?><!--"><br>-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                    <label for="title">Apercu de l'image : </label><br>-->
<!--                    <img src="--><?//= $post->getMainImage() ?><!--" alt="Main image"><br>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="row">-->
<!--                <div class="col">-->
<!--                    <label for="title">Small image URL :</label><br>-->
<!--                    <input type="text" class="form-control" name="small_image" value="--><?//= $post->getSmallImage() ?><!--"><br>-->
<!--                </div>-->
<!--                <div class="col">-->
<!--                    <label for="title">Apercu de l'image : </label><br>-->
<!--                    <img src="--><?//= $post->getSmallImage() ?><!--" alt="Small image"><br>-->
<!--                </div>-->
<!--            </div>-->
<!--            <br>-->
<!--            <div class="form-group">-->
<!--                <label for="title">Id Author : </label>-->
<!--                <input type="text" class="form-control" name="user_id" value="--><?//= $post->getUserId() ?><!--"><br>-->
<!--            </div><div class="form-group">-->
<!--                <label for="title">Status : </label>-->
<!--                <input type="text" class="form-control" name="status" value="--><?//= $post->getStatus() ?><!--"><br>-->
<!--            </div>-->




            <button class="btn-primary">Modifier</button>

        </form>


</div>
</section>



<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>
