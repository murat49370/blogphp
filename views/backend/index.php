
<?php $title= 'Accueil Murat Blog'; ?>

<?php ob_start(); ?>

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <h1 class="masthead-heading text-uppercase mb-0">Admin du site</h1>
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section admin" >
    <div class="container">

        <h2 class="page-section-heading text-center  text-secondary mb-0">Tableaux de bord</h2>

    </div>
</section>


<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('layouts/default.php'); ?>
