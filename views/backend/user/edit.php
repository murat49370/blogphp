
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un post</h1>
</header>
<div class="container">
    <?php if ($success):  ?>
        <div class="alert alert-success">
            L'utilisateur a bien été modifié
        </div>
    <?php endif ?>

<!-- Posts Section-->
<section class="page-section posts" id="posts">
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification de l'utilisateur id N° <?= $user->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="?modif" method="post">
            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" class="form-control" name="email" required value="<?= $user->getEmail() ?>"><br>
            </div>
            <div class="form-group">
                <label for="title">Password : </label>
                <input type="password" class="form-control" name="password" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">First name :</label><br>
                <input type="text" class="form-control" name="first_name" value="<?= $user->getFirstName() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Last name :</label><br>
                <input type="text" class="form-control" name="last_name" value="<?= $user->getLastName() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Pseudo :</label><br>
                <input type="text" class="form-control" name="pseudo" value="<?= $user->getPseudo() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Status : </label>
                <select name="role" id="status" required>
                    <option value="admin">admin</option>
                    <option value="waiting">en attente</option>
                </select>
            </div>

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

