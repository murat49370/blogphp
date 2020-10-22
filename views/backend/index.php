
<?php $title= 'Accueil Murat Blog'; ?>

<?php ob_start(); ?>

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="masthead-heading text-uppercase mb-0">Administration du site</h1>
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section admin" >
    <div class="container">
        <h2 class="page-section-heading text-center  text-secondary mb-0">Bienvenue <?= $user->getFirstName()?> <?= $user->getLastName()?></h2>
    </div>
</section>



<?php $content = ob_get_clean(); ?>
<?php require('layouts/default.php'); ?>
