<?php $title= $post->getTitle(); ?>

<?php ob_start(); ?>



<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="text-center"><?= $post->getTitle() ?></h1>
        <p>Par Admin | Dans Morbi leo risus | Le <?php echo $post->getCreateDate()->format('d F Y');?></p>
    </div>
</header>

<section class="post-content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="image-block">
                    <img src="<?= $post->getMainImage() ?>"  alt="Main image" />
                </div>
                <p><?= $post->getContent() ?></p>
            </div>

<!-- Side Barre-->
            <div class="col-lg-3  col-md-3 col-sm-12">
                <div class="well">
                    <h2>Catégories liste</h2>
                    <ul class="list-group">
                        <li class="list-group-item"><a href="#">Morbi leo risus</a></li>
                        <li class="list-group-item"><a href="#">Dapibus ac facilisis in</a></li>
                        <li class="list-group-item"><a href="#">Porta ac consectetur ac</a></li>
                        <li class="list-group-item"><a href="#">Vestibulum at eros</a></li>
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

