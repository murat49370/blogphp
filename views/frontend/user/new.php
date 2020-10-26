
<?php $title= 'Inscription utilisateur'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Inscription utilisateur</h1>
</header>
<div class="container">

    <!-- Posts Section-->
    <section class="page-section posts" id="posts">
        <?php
        if(!empty($_SESSION["flash"]['success_new_user']))
        {
            $message = $_SESSION["flash"]['success_new_user'];
            $_SESSION['flash']['success_new_user'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>

        <!-- Posts Section Heading-->

        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" class="form-control" name="email" required value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Mot de passe : </label>
                <input type="password" class="form-control" name="password" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Nom :</label><br>
                <input type="text" class="form-control" name="first_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Prénom :</label><br>
                <input type="text" class="form-control" name="last_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Pseudo :</label><br>
                <input type="text" class="form-control" name="pseudo" value="" required><br>
            </div>

            <button class="btn btn-primary">Inscription</button>

        </form>

</div>



<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

