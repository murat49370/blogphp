
<?php ob_start(); ?>

<!-- Masthead-->

<!-- Portfolio Section-->
<section class="page-section admin" >
    <br>
    <br>
    <div class="container">

        <?php
        if(!empty($_SESSION['flash']['success_logout']))
        {
            $message = $_SESSION["flash"]['success_logout'];
            $_SESSION['flash']['success_logout'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION["flash"]['success_new_user']))
        {
            $message = $_SESSION["flash"]['success_new_user'];
            $_SESSION['flash']['success_new_user'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }

        if(!empty($_SESSION["flash"]['error_login_page']))
        {
            $message = $_SESSION["flash"]['error_login_page'];
            $_SESSION['flash']['error_login_page'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>

        <?php if(isset($_GET['forbidden'])) :?>
            <div class="alert alert-success">
                Vous devez être connecté pour accéder à cette page.
            </div>
        <?php endif; ?>

        <h2 class="page-section-heading text-center  text-secondary mb-0">Se connecter</h2>





        <form action="<?= $router->generate('login') ?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?php if(isset($user)) {$user->getEmail();}?>" placeholder="Votre email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Votre mots de passe">
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
        <br>
        <p>Vous souhaiter vous inscrire?</p>
        <a href="<?=$router->generate('registration') ?>"> >>> Inscription</a>

    </div>
</section>



<?php $content = ob_get_clean(); ?>
<?php require('layouts/default.php'); ?>




