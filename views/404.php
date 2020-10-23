<?php
http_response_code(404);
?>


<?php $title= '404'; ?>

<?php ob_start(); ?>

<section class="page_404">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <div class="col-sm-10 col-sm-offset-1  text-center">
                    <br>
                    <br>
                    <br>
                    <br>

                    <div class="four_zero_four_bg">
                        <h1 class="text-center ">404</h1>
                    </div>
                    <div class="contant_box_404">
                        <h3 class="h2">
                            Oups ! Erreur 404 ...
                        </h3>
                        <p>La page que vous rechercher n'exite pas!</p>
                        <a href="/" class="link_404">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $content = ob_get_clean(); ?>
<?php require('frontend/layouts/default.php'); ?>

