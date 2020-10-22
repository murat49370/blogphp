
<?php $title= 'Liste des utilisateurs'; ?>

<?php ob_start(); ?>


<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un post</h1>
</header>
<div class="container">


<!-- Posts Section-->
<section class="page-section" id="">
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification du mot de passe pour l'utilisateur id N° # <?= $user->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Ancien mot de passe : </label>
                <input type="password" class="form-control" name="old_password" required value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Nouveau mot de password : </label>
                <input type="password" class="form-control <?= isset($errors['new_password']) ? 'is-invalid' : '' ?>" name="new_password" required value=""><br>
                <?php if (isset($errors['new_password'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['new_password']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Répéter le nouveau mot de password : </label>
                <input type="password" class="form-control" name="new_password_rep" required value=""><br>
            </div>
            <button class="btn-primary">Modifier</button>
        </form>
</div>
</section>



<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>

