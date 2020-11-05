
<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un commentaire</h1>
</header>
<div class="container">
    <?php if (!empty($errors)):  ?>
        <div class="alert alert-danger">
            La catégorie n'a pas pu être modifié merci de corriger vos erreurs
        </div>
    <?php endif ?>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification du commentaire id N° <?= $comment->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
    <form action="" method="post">
        <div class="form-group">
            <label for="post_id">Post id : </label>
            <input type="text" class="form-control <?= isset($errors['post_id']) ? 'is-invalid' : '' ?>" name="post_id" value="<?= $comment->getPostId() ?>">
            <?php if (isset($errors['post_id'])) : ?>
                <div class="invalid-feedback"><?= implode('<br>', $errors['post_id']) ?></div>
            <?php endif; ?>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="author_name">Author Name : </label>
                <input type="text" class="form-control <?= isset($errors['author_name']) ? 'is-invalid' : '' ?>" name="author_name" value="<?= $comment->getAuthorName() ?>">
                <?php if (isset($errors['author_name'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['author_name']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="author_email">Author Email : </label>
                <input type="email" class="form-control <?= isset($errors['author_email']) ? 'is-invalid' : '' ?>" name="author_email" value="<?= $comment->getAuthorEmail() ?>">
                <?php if (isset($errors['author_email'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['author_email']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="content">Contenue du commentaire :</label><br>
                <textarea class="form-control <?= isset($errors['content']) ? 'is-invalid' : '' ?>" name="content" id="content" rows="5" ><?= $comment->getContent() ?> </textarea>
                <?php if (isset($errors['content'])) : ?>
                    <div class="invalid-feedback"><?= implode('<br>', $errors['content']) ?></div>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="comment_status">Changer le status du commentaire :</label>
                <select name="comment_status" id="comment_status">
                    <option value="publish">Publier</option>
                    <option value="waiting">En attente de validation</option>
                    <option value="refused">Refusé</option>
                </select>
            </div>
            <button class="btn-primary">Validé les modifications</button>
        </form>
</div>


