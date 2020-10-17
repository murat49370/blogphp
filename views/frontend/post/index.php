<?php $title= $post->getTitle(); ?>

<?php ob_start(); ?>



<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="text-center"><?= htmlentities($post->getTitle()) ?></h1>
        </p>
    </div>
</header>
<!-- Page Content -->
<div class="container">


    <div class="row">


        <!-- Post Content Column -->
        <div class="col-lg-8">

            <?php if (isset($_GET['publish_comment'])):  ?>
                <div class="alert alert-success">
                    Le commentaire a bien été enregistré, il sera publié aprés sa validation.
                </div>
            <?php endif ?>

            <!-- Title -->
            <h1 class="mt-4"><?= htmlentities($post->getTitle()) ?></h1>

            <!-- Author -->
            <p class="lead">
                Par
                <a href="#">Admin</a>
                <!-- Post Categories -->
                Dans :
                <?php
                //dd($categories);
                foreach ($categories as $k => $category): ?>
                    <?php if($k > 0): ?>
                        ,
                    <?php endif;?>

                    <a href="<?= $router->generate('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>" > <?= $category->getTitle() ?></a>

                <?php endforeach; ?>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><?php echo $post->getCreateDate()->format('d F Y');?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" src="<?= $post->getMainImage() ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p><?= nl2br(htmlentities($post->getContent())) ?></p>

            <hr>


            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Votre nom :</label>
                            <input type="text" class="form-control" id="author_name" name="author_name" ">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Votre message :</label>
                            <textarea class="form-control" rows="3" name="content" id="content"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="hidden" type="text" class="form-control" value="<?= $post->getId() ?>" id="post_id" name="post_id" ">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyé</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <?php foreach ($comments as $comment) { ?>
            <div class="media mb-4">
                <img class="w-25 p-3 rounded-circle" src="https://www.agem-bordeaux.fr/images/sampledata/icons/avatar-big.png" alt="">
                <div class="media-body">
                    <h5 class="mt-0"><?= $comment->getAuthorName() ?></h5>
                    <p>Publié le <?= $comment->getCreateDate()->format('d F Y') ?></p>
                    <?= nl2br(htmlentities($comment->getContent())) ?>

                </div>
            </div>
            <?php } ?>
        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Categories Widget -->
            <div class="card my-4">
                <h5 class="card-header">Liste des categories</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 justify-content-center">
                            <ul class="list-unstyled mb-0">
                                <?php

                                foreach ($categoriesListing as $category)
                                { ?>
                                    <?php $url = $router->generate('category', ['id' => $category->getId(), 'slug' => $category->getSlug()]);?>

                                    <li class="list-group"><a href="<?= $url ?>"><?= $category->getTitle() ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Exemple Widget</h5>
                <div class="card-body">
                    You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->





<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>



<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

