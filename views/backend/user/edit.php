<!-- Masthead-->

<header class="masthead bg-primary text-white text-center">
    <h1>Modification d'un utilisateur</h1>
</header>
<div class="container">


<!-- Posts Section-->
<section class="page-section posts" id="posts">
        <!-- Posts Section Heading-->
        <h2 class="page-section-heading text-center text-secondary mb-0">Modification de l'utilisateur id N° <?= $user->getId() ?></h2>
        <br>
        <br>
        <!-- Posts Grid Items-->
        <form action="?modif" method="post">
            <div class="form-group">
                <label for="title">Email : </label>
                <input type="text" class="form-control" name="email" required value="<?= $user->getEmail() ?>"><br>
            </div>
            <div class="form-group">
                <label for="title">Nom :</label><br>
                <input type="text" class="form-control" name="first_name" value="<?= $user->getFirstName() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Prénom :</label><br>
                <input type="text" class="form-control" name="last_name" value="<?= $user->getLastName() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Pseudo :</label><br>
                <input type="text" class="form-control" name="pseudo" value="<?= $user->getPseudo() ?>" required><br>
            </div>
            <div class="form-group">
                <label for="title">Status : </label>
                <select name="role" id="status" required>
                    <option value="admin">admin</option>
                    <option value="waiting">en attente</option>
                </select>
            </div>

            <button class="btn-primary">Modifier</button>

        </form>

</div>
</section>


