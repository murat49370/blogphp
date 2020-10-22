
<?php $title= 'Administration utilisateur'; ?>

<?php ob_start(); ?>


<header class="masthead bg-primary text-white text-center">
    <h1>Liste des utilisateurs</h1>
</header>

<section class="page-section posts" id="posts">
    <div class="container">
        <?php
        if(!empty($_SESSION["flash"]['passmodif'] ))
        {
            $message = $_SESSION["flash"]['passmodif'];
            $_SESSION["flash"]['passmodif'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION["flash"]['newUser'] ))
        {
            $message = $_SESSION["flash"]['newUser'];
            $_SESSION["flash"]['newUser'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION["flash"]['deleteUser'] ))
        {
            $message = $_SESSION["flash"]['deleteUser'];
            $_SESSION["flash"]['deleteUser'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        ?>
        <h2 class="page-section-heading text-center text-secondary mb-0">Utilisateurs inscrits</h2>
        <a href="<?= $router->generate('admin_new_user') ?>" class="btn btn-primary" style="display:inline">Ajouter un utilisateur</a>
        <br>
        <br>
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
                    <td class="<?php echo $user->getRole() === 'admin' ? 'btn-primary' : 'btn-warning'; ?>"><?= $user->getRole()?></td>
                    <td><?= $user->getPseudo() ?></td>
                    <td><?= $user->getFirstName() . ' ' . $user->getLastName() ?></td>
                    <td>
                        <a href="<?= $router->generate('admin_edit_user_password', ['id' => $user->getId()]) ?>" class="btn btn-secondary">Changer mot de passe</a>
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

