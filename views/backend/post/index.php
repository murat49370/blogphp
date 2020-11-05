
<header class="masthead bg-primary text-white text-center">
    <h1>Administration des articles</h1>

</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <?php
        if(!empty($_SESSION['flash']['success_new_post'] ))
        {
            $message = $_SESSION["flash"]['success_new_post'];
            $_SESSION['flash']['success_new_post'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION["flash"]['deletePostOk'] ))
        {
            $message = $_SESSION["flash"]['deletePostOk'];
            $_SESSION['flash']['deletePostOk'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION['flash']['success_edit_post'] ))
        {
            $message = $_SESSION["flash"]['success_edit_post'];
            $_SESSION['flash']['success_edit_post'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>
        <!-- Pagination-->
        <div class="d-flex justify-content-between my-4">

            <?php if ($currentPage > 1): ?>
                <a href="<?= $router->generate('admin_list_post')?>?page=<?= $currentPage - 1 ?>" class="btn btn-primary">&laquo; Page précédente</a>
            <?php endif; ?>
            <?php if ($currentPage < $pages): ?>
                <a href="<?= $router->generate('admin_list_post')?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
            <?php endif; ?>
        </div>

        <h2 class="page-section-heading text-center text-secondary mb-0">Liste des articles</h2>
        <a href="<?= $router->generate('admin_new_post') ?>" class="btn btn-primary" style="display:inline">Ajouter un nouveau post</a>
        <br>
        <br>

        <table class="table">
            <thead>
                <th>Id</th>
                <th>Status</th>
                <th>Titre</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td># <?= $post->getid() ?></td>
                    <td class="
                    <?php
                    echo $post->getStatus() === 'publish' ? 'btn-primary' : 'btn-warning';
                    ?>"><?= $post->getStatus()?></td>
                    <td><?= $post->getTitle() ?></td>
                    <td>
                        <a href="<?= $router->generate('admin_edit_post', ['id' => $post->getId()]) ?>" class="btn btn-primary">Editer</a>
                        <form action="<?= $router->generate('admin_delete_post', ['id' => $post->getId()]) ?>" method="post"
                        onsubmit="return confirm('Voulez vous effectué cette action?')" style="display:inline">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</section>


