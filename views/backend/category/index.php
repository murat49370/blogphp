
<?php $title= 'Post Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Liste des Categories</h1>

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
        <h2 class="page-section-heading text-center text-secondary mb-0">Categories Manager</h2>
        <a href="<?= $router->generate('admin_new_category') ?>" class="btn btn-primary" style="display:inline">Ajouter une category</a>
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
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td># <?= $category->getid() ?></td>
                    <td><?= $category->getTitle() ?></td>
                    <td>
                        <a href="<?= $router->generate('admin_edit_category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>" class="btn btn-primary">Editer</a>
                        <form action="<?= $router->generate('admin_delete_category', ['id' => $category->getId(), 'slug' => $category->getSlug()]) ?>" method="post"
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

