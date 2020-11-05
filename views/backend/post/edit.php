
<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un post</h1>
</header>
<div class="container">
    <?php if (!empty($errors)):  ?>
        <div class="alert alert-danger">
            L'article n'a pas pu être modifié merci de corriger vos erreurs
        </div>
    <?php endif ?>

<!-- Posts Section-->
<section class="page-section posts" id="posts">

        <h2 class="page-section-heading text-center text-secondary mb-0">Modification du post id N° <?= $post->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="?modif" method="post">

            <div class="form-group">
                <label for="title">Titre : </label>
                <input type="text" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" name="title" value="<?= $post->getTitle() ?>" required>
                <?php if (isset($errors['title'])) : ?>
                <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Slug : </label>
                <input type="text" class="form-control <?= isset($errors['slug']) ? 'is-invalid' : '' ?>" name="slug" value="<?= $post->getSlug() ?>">
                <?php if (isset($errors['slug'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['slug']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Short contenue :</label><br>
                <textarea class="form-control <?= isset($errors['short_content']) ? 'is-invalid' : '' ?>" name="short_content" id="short_content" rows="5" ><?= $post->getShortContent() ?></textarea>
                <?php if (isset($errors['short_content'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['short_content']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Contenue :</label><br>
                <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>" name="content" id="content" rows="20" ><?= $post->getcontent() ?></textarea>
                <?php if (isset($errors['content'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['content']) ?></div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col">
                    <label for="title">Main image URL :</label><br>
                    <input type="text" class="form-control <?= isset($errors['main_image']) ? 'is-invalid' : '' ?>" name="main_image" value="<?= $post->getMainImage() ?>">
                    <?php if (isset($errors['main_image'])) : ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['main_image']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="title">Apercu de l'image : </label><br>
                    <img src="<?= $post->getMainImage() ?>" alt="Main image" ><br>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="title">Small image URL :</label><br>
                    <input type="text" class="form-control <?= isset($errors['small_image']) ? 'is-invalid' : '' ?>" name="small_image" value="<?= $post->getSmallImage() ?>">
                    <?php if (isset($errors['small_image'])) : ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['small_image']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="title">Apercu de l'image : </label><br>
                    <img src="<?= $post->getSmallImage() ?>" alt="Small image"><br>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="title">Status : </label>
                <select name="status" id="status">
                    <option value="publish">publish</option>
                    <option value="draft">draft</option>
                </select>
            </div>

            <?php
            $optionsHTML = [];
            foreach($options as $k => $v)
            {
                $selected = in_array($k, $idsCategoriesPost) ? " selected" : "";
                $optionHTML[] = "<option value=\"$k\"$selected>$v</option>option>";
            }
            $optionsHTML = implode('', $optionHTML);

            ?>

            <div class="form-group">
                <label for="category">categories : </label>
                <select name="categories[]" id="category" required multiple><?= $optionsHTML ?></select>
            </div>

            <button class="btn-primary">Modifier</button>

        </form>


</div>
</section>


