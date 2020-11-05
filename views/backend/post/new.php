
<header class="masthead bg-primary text-white text-center">
    <h1>Création d'un article</h1>
</header>

<div class="container">
    <!-- Posts Section-->
    <section class="page-section posts" id="posts">

        <?php  if (!empty($errors)) : ?>
            <div class="alert alert-danger">L'article n'a pas pue être modifié, merci de corriger vos erreurs.</div>
        <?php endif; ?>
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Formualire création d'un article </h2>
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
                <?php if(isset($errors['title'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Short contenue :</label><br>
                <textarea class="form-control <?= isset($errors['short_content']) ? 'is-invalid' : '' ?>" name="short_content" id="short_content" rows="5" ></textarea>
                <?php if(isset($errors['title'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="title">Contenue :</label><br>
                <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>" name="content" id="content" rows="20" ></textarea>
                <?php if(isset($errors['title'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                <?php endif; ?>
            </div>
            <div class="row">
                <div class="col">
                    <label for="title">Main image URL :</label><br>
                    <input type="text" class="form-control <?= isset($errors['main_image']) ? 'is-invalid' : '' ?>" name="main_image" value="">
                    <?php if(isset($errors['title'])) : ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="title">Apercu de l'image : </label><br>
                    <img src="" alt="Main image"><br>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <label for="title">Small image URL :</label><br>
                    <input type="text" class="form-control <?= isset($errors['small_image']) ? 'is-invalid' : '' ?>" name="small_image" value="">
                    <?php if(isset($errors['title'])) : ?>
                        <div class="invalid-feedback"><?= implode('<br>', $errors['title']) ?></div>
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="title">Apercu de l'image : </label><br>
                    <img src="" alt="Small image"><br>
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
            <button class="btn-primary">Crée l'article</button>
        </form>

</div>


