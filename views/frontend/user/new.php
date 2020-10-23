
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
        <h2 class="page-section-heading text-center text-secondary mb-0">Inscription utilisateur </h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" class="form-control" name="email" required value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Password : </label>
                <input type="password" class="form-control" name="password" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">First name :</label><br>
                <input type="text" class="form-control" name="first_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Last name :</label><br>
                <input type="text" class="form-control" name="last_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Pseudo :</label><br>
                <input type="text" class="form-control" name="pseudo" value="" required><br>
            </div>

            <button class="btn-primary">Inscription</button>

        </form>

</div>
</section>



<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('../views/frontend/layouts/default.php'); ?>

