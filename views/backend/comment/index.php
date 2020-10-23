
<?php $title= 'List des commentaires'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Administration des commentaires</h1>

</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <?php
        if(!empty($_SESSION['flash']['success_edit_comment'] ))
        {
            $message = $_SESSION["flash"]['success_edit_comment'];
            $_SESSION['flash']['success_edit_comment'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION['flash']['success_delete_comment'] ))
        {
            $message = $_SESSION['flash']['success_delete_comment'];
            $_SESSION['flash']['success_delete_comment'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION['flash']['success_update_comment_status'] ))
        {
            $message = $_SESSION['flash']['success_update_comment_status'];
            $_SESSION['flash']['success_update_comment_status'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">List des commentaires</h2>

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
                    echo $comment->getStatus() === 'publish' ? 'btn-primary' : 'btn-warning';
                    ?>
                    "><?= $comment->getStatus()?></td>
                    <td><?= $comment->getContent() ?></td>
                    <td class="table-inline">

                        <form action="<?= $router->generate('admin_update_status_comment', ['id' => $comment->getId(), 'status' => 'publish']) ?>" method="post"
                              onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-secondary">Validé</button>
                        </form>
                        <pre> </pre>
                        <a href="<?= $router->generate('admin_edit_comment', ['id' => $comment->getId()]) ?>" class="btn btn-primary">Editer</a>
                        <pre> </pre>
                        <form action="<?= $router->generate('admin_delete_comment', ['id' => $comment->getId()]) ?>" method="post"
                              onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-danger">Supprimé</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>

