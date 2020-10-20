
<?php $title= 'User Manager'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Liste des utilisateurs</h1>

</header>
<!-- Posts Section-->
<section class="page-section posts" id="posts">
    <div class="container">
        <?php if (isset($_GET['delete'])): ?>
            <div class="alert alert-success">
                L'enregistrement a bien été supprimé.
            </div>
        <?php endif ?>
        <?php if (isset($_GET['success_new_user'])): ?>
            <div class="alert alert-success">
                L'utilisateur a bien été crée.
            </div>
        <?php endif ?>


        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Users Manager</h2>
        <a href="<?= $router->generate('admin_new_user') ?>" class="btn btn-primary" style="display:inline">Ajouter un utilisateur</a>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <table class="table">
            <thead>
                <th>Id</th>
                <th>Status</th>
                <th>Pseudo</th>
                <th>Nom et prénom</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td># <?= $user->getid() ?></td>
                    <td class="
                    <?php
                    if ($user->getRole() === 'admin'){echo 'btn-primary';}
                    if ($user->getRole() === 'waiting'){echo 'btn-secondary';}
                    ?>"><?= $user->getRole()?></td>
                    <td><?= $user->getPseudo() ?></td>
                    <td><?= $user->getFirstName() . ' ' . $user->getLastName() ?></td>

                    <td>
                        <a href="<?= $router->generate('admin_edit_user', ['id' => $user->getId()]) ?>" class="btn btn-primary">Editer</a>
                        <form action="<?= $router->generate('admin_delete_user', ['id' => $user->getId()]) ?>" method="post"
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

