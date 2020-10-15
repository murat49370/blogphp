
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Liste des posts et actions</h1>
</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <?php if (isset($_GET['delete'])): ?>
            <div class="alert alert-success">
                L'enregistrement a bien été supprimé.
            </div>
        <?php endif ?>
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Posts Manager</h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Titre</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td># <?= $post->getid() ?></td>
                    <td><?= $post->getTitle() ?></td>
                    <td>
                        <a href="<?= $router->generate('admin_edit_post', ['id' => $post->getId()]) ?>" class="btn btn-primary">Editer</a>
                        <form action="<?= $router->generate('admin_delete_post', ['id' => $post->getId()]) ?>" method="post"
                        onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-danger">Supprimé</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</section>



<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>
