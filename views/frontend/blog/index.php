<?php $title= 'Blog'; ?>

<?php ob_start(); ?>

<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">Le Blog</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Le Blog d'un développeur PHP</p>

    </div>
</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Les derniers articles du Blog</h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <div class="row">
            <div class="container">
                <div class="row">
                    <?php
                    foreach ($posts as $post)
                    { ?>
                    <div class="col-md-4">
                        <div class="single-blog-item">
                            <div class="blog-thumnail">
                                <a href=""><img src="<?php echo $post->getSmallImage();?>" alt="blog-img"></a>
                            </div>
                            <div class="blog-content">
                                <h4><a href="#"><?php echo $post->getTitle();?></a></h4>
                                <p><?php echo $post->getShortContent();?></p>
                                <a href="<?= $router->generate('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="more-btn">En savoir plus</a>
                            </div>
                            <span class="blog-date">Publié le <?php echo $post->getCreateDate()->format('d F Y');?></span>
                        </div>
                    </div>
                    <?php } ?>
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

