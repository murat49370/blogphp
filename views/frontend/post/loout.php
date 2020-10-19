
<?php ob_start(); ?>

<!-- Masthead-->

<!-- Portfolio Section-->
<section class="page-section admin" >
    <br>
    <br>
    <div class="container">
        <?php if(isset($_GET['forbidden'])) :?>
            <div class="alert alert-danger">
                Vous ne pouvez accéder à cette page
            </div>
        <?php endif; ?>

        <h2 class="page-section-heading text-center  text-secondary mb-0">Se connecter</h2>





        <form action="<?= $router->generate('login') ?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?= $user->getEmail()?>" placeholder="Votre email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Votre mots de passe">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>

    </div>
</section>





<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('layouts/default.php'); ?>




