
<?php $title= "Edition d'une catégorie"; ?>

<?php ob_start(); ?>


<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'une catégorie</h1>
</header>
<div class="container">
    <?php if (!empty($errors)):  ?>
        <div class="alert alert-danger">
            La catégorie n'a pas pu être modifié merci de corriger vos erreurs
        </div>
    <?php endif ?>

<section class="page-section posts" id="posts">
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification de la catégorie id N° <?= $category->getId() ?></h2>
        <br>
        <br>
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Titre : </label>
                <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="title" value="<?= $category->getTitle() ?>">
                <?php if (isset($errors['title'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="slug">Slug : </label>
                <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="slug" value="<?= $category->getSlug() ?>">
                <?php if (isset($errors['slug'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['slug']) ?></div>
                <?php endif; ?>
            </div>
            <button class="btn-primary">Validé les modifications</button>
        </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>

