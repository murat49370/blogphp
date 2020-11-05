
<header class="masthead bg-primary text-white text-center">
    <h1>Ajout d'une category</h1>
</header>
<div class="container">
        <!-- Posts Section-->
    <section class="page-section posts" id="posts">
        <?php  if (!empty($errors)) : ?>
            <div class="alert alert-danger">La categorie n'a pas pue être modifié, merci de corriger vos erreurs.</div>
        <?php endif; ?>

        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Création d'une categorie</h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="" method="post">
            <div class="form-group">
                <label for="title">Titre : </label>
                <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="title" value="">
                <?php if(isset($errors['title'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Slug : </label>
                <input type="text" class="form-control <?= isset($errors['slug']) ? 'is-invalid' : '' ?>" name="slug" value="">
                <?php if(isset($errors['slug'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['slug']) ?></div>
                <?php endif; ?>
            </div>
            <button class="btn-primary">Crée la catégorie</button>

        </form>
</div>
</section>


