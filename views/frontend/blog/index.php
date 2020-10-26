<?php $title= 'Le Blog - Murat CAN'; ?>

<?php ob_start(); ?>


<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="page-section-heading text-center mb-0">Les derniers articles du Blog</h1>
    </div>
</header>



<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <!-- Pagination-->
        <div class="d-flex justify-content-between my-4">

            <?php if ($currentPage > 1): ?>
                <a href="<?= $router->generate('blog_home')?>?page=<?= $currentPage - 1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
            <?php endif; ?>
            <?php if ($currentPage < $pages): ?>
                <a href="<?= $router->generate('blog_home')?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
            <?php endif; ?>
        </div>

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
                            <span class="blog-date">Publié le <?php echo $post->getCreateDate()->format('d/m/Y');?></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
    </div>
</section>



<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

