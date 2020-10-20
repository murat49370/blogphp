
<?php $title= 'Création d\'un article'; ?>

<?php ob_start(); ?>



<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Création d'un article</h1>
</header>
<div class="container">

    <?php if (isset($_GET['success_new_user']))
    {
        header('Location: ' . $router->generate('admin_list_user') . '?success_new_user=1');
    }
        ?>


    <!-- Posts Section-->
    <section class="page-section posts" id="posts">

        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Création d'un utilisateur </h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="?success_new_user=1" method="post">
            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" class="form-control" name="email" required value=""><br>
            </div>
            <div class="form-group">
                <label for="title">Password : </label>
                <input type="password" class="form-control" name="password" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">First name :</label><br>
                <input type="text" class="form-control" name="first_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Last name :</label><br>
                <input type="text" class="form-control" name="last_name" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Pseudo :</label><br>
                <input type="text" class="form-control" name="pseudo" value="" required><br>
            </div>
            <div class="form-group">
                <label for="title">Status : </label>
                <select name="role" id="status" required>
                    <option value="admin">admin</option>
                    <option value="waiting">en attente</option>
                </select>
            </div>

            <button class="btn-primary">Crée l'utilisateur</button>

        </form>

</div>
</section>



<?php $content = ob_get_clean(); ?>
<?php require('../views/backend/layouts/default.php'); ?>

