
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
        <?php if (isset($_GET['status'])): ?>
            <div class="alert alert-success">
                Le commentaire a bien été validé'.
            </div>
        <?php endif ?>
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Comments Manager</h2>

        <br>
        <br>
        <!-- Pagination-->
        <div class="d-flex justify-content-between my-4">
            <?php if ($currentPage > 1): ?>
                <a href="<?= $router->generate('admin_list_comment')?>?page=<?= $currentPage - 1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
            <?php endif; ?>
            <?php if ($currentPage < $pages): ?>
                <a href="<?= $router->generate('admin_list_comment')?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
            <?php endif; ?>

        </div>

        <!-- Posts Grid Items-->

        <table class="table">
            <thead>
            <th>Id</th>
            <th>Status</th>
            <th>Titre</th>
            <th>Actions</th>
            </thead>
            <tbody>
            <?php foreach ($comments as $comment): ?>
                <tr>
                    <td># <?= $comment->getid() ?></td>

                    <td class="
                    <?php
                    if ($comment->getStatus() === 'publish'){echo 'btn btn-primary';}
                    if ($comment->getStatus() === 'waiting'){echo 'btn btn-danger';}
                    ?>
                    "><?= $comment->getStatus()?></td>
                    <td><?= $comment->getContent() ?></td>
                    <td>
                        <a href="<?= $router->generate('admin_edit_comment', ['id' => $comment->getId()]) ?>" class="btn btn-primary">Editer</a>
                        <form action="<?= $router->generate('admin_delete_comment', ['id' => $comment->getId()]) ?>" method="post"
                              onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-danger">Supprimé</button>
                        </form>
                        <form action="<?= $router->generate('admin_update_status_comment', ['id' => $comment->getId(), 'status' => 'publish']) ?>" method="post"
                                     onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-danger">Validé</button>
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

