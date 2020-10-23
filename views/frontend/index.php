
<?php $title= 'Accueil Murat Blog'; ?>

<?php ob_start(); ?>

<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <img class="masthead-avatar mb-5" src="/assets/img/murat-can.png" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">Murat CAN</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0">Développeur PHP / Symfony</p>
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <?php
        if (isset($_GET['response']))
        {
            if($_GET['response'] === 'success')
            {
                echo '<div class="alert alert-success">
                Vous message a bien été envoyer.
            </div>';
            }else{
                echo 'Il y a une erreur dans l\'envoi du message.';
            }
        }?>

        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>

        <?php
        if(!empty($_SESSION['flash']['success_mail']))
        {
            $message = $_SESSION['flash']['success_mail'];
            $_SESSION['flash']['success_mail'] = [];
            echo '<div class="alert alert-success">' . $message . '</div>';
        }
        if(!empty($_SESSION['flash']['error_login_page']))
        {
            $message = $_SESSION['flash']['error_mail'];
            $_SESSION['flash']['error_mail'] = [];
            echo '<div class="alert alert-danger">' . $message . '</div>';
        }
        ?>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row">
            <!-- Portfolio Item 1-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/ouest-anjou.jpg" alt="" />
                </div>
            </div>
            <!-- Portfolio Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal2">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/l-institut.jpg" alt="" />
                </div>
            </div>
            <!-- Portfolio Item 3-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal3">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/festival.jpg" alt="" />
                </div>
            </div>
            <!-- Portfolio Item 4-->
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal4">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/Chalet-caviar.jpg" alt="" />
                </div>
            </div>
            <!-- Portfolio Item 5-->
            <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal5">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/murat-can.jpg" alt="" />
                </div>
            </div>
            <!-- Portfolio Item 6-->
            <div class="col-md-6 col-lg-4">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal6">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid border" src="/assets/img/portfolio/expressFood.jpg" alt="" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
    <div class="container">
        <!-- About Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-white">Qui suis-je</h2>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- About Section Content-->
        <div class="row">
            <div class="col-lg-4 ml-auto"><p class="lead">Je suis Murat, Développeur d'apllication PHP / Symfony à Angers. J'ai entamer une reconvesion dans le développement php depuit  2 ans. J'ai une bonne culture informatique avec plus de 10 d'expérience dans le web marketing et la création de site avec Wordpresse comme freealance.</p></div>
            <div class="col-lg-4 mr-auto"><p class="lead">Mes compétances :<br>
                    - Développement d'application en PHP,<br>
                    - Framework Symfony,<br>
                    - Création de site avec Wordpresse,<br>
                    - Gestion de projet informatique,<br>
                    - Optimisation : SEO - SEA</p>
            </div>
        </div>
        <!-- About Section Button-->
        <div class="text-center mt-4">
            <a class="btn btn-xl btn-outline-light" href="/assets/CV-murat-can.pdf">
                <i class="fas fa-download mr-2"></i>
                Voir mon CV
            </a>
        </div>
    </div>
</section>
<!-- Contact Section-->
<section class="page-section" id="contact">
    <div class="container">
        <!-- Contact Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Contactez moi</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>


        <!-- Contact Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <form action="/mail" method="post" id="contactForm">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="exampleFormControlInput1">Votre Email</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Nom">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="exampleFormControlInput1">Votre Email :</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="exampleFormControlInput1">Votre Tel :</label>
                            <input type="text" class="form-control" id="phone" name="phone" required placeholder="Téléphone">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label for="exampleFormControlInput1">Votre message :</label>
                            <textarea class="form-control" rows="3" name="message" id="message" required placeholder="Message"></textarea>
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary btn-xl">Envoyer</button>
                </form>


            </div>
        </div>
    </div>
</section>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes)-->
<div class="scroll-to-top d-lg-none position-fixed">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top"><i class="fa fa-chevron-up"></i></a>
</div>
<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Anjou Ouest</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid border rounded mb-5" src="/assets/img/portfolio/ouest-anjou.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Création d'un site Internet pour le pôle de santé Anjou Ouest. Pour ce projet, j'ai utilisé WordPress et créer un template avec les couleurs du logo existant.<br>
                                <br>
                                <strong>Technologie utilisée : </strong> WordPress.<br />
                                <strong>Prestations :</strong> création du site Internet, hébergement et optimisation du référencement naturel.<br>
                                <strong>Voir le site :</strong> <a href="https://sante-ouest-anjou.com">Pôle santé</a>
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 2-->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-labelledby="portfolioModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal2Label">L'institut</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="/assets/img/portfolio/l-institut.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Création d'un site Internet pour "l'Institut", institut de beauté à Angers. Suite à une création d'activité, je me suis chargé de la création du leur site internet et prestation de conseil en communication.<br>
                                <br>
                                <strong>Technologie utilisée : </strong> WordPress.<br />
                                <strong>Prestations :</strong> création du site Internet, hébergement et optimisation du référencement naturel.<br>
                                <strong>Voir le site :</strong> <a href="https://institut-angers.fr">Institut de beauté à  Angers</a>
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 3-->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-labelledby="portfolioModal3Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal3Label">Festival des films</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="/assets/img/portfolio/festival.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Projet réalisé dans le cadre de ma formation développeur PHP. Pour ce projet, j'ai analysé les besoins d'une association pour son projet de festival et j'ai réalisé une maquette en HTML. J'ai également réalisé un cahier des charges qui résument les besoins avec une proposition commerciale.<br>
                                <br>
                                <strong>Technologie utilisée : </strong> WordPress.<br />
                                <strong>Réalisations :</strong> analyse des besoins, création d'une maquette en HTML, rédiger les spécifications détaillées du projet.<br>
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 4-->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-labelledby="portfolioModal4Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal4Label">Chalet et caviar</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="/assets/img/portfolio/Chalet-caviar.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Projet réalisé dans le cadre de ma formation développeur PHP. Pour ce projet, j'ai choisi, personnaliser et intégrer un thème WordPress. J'ai également produit une documentation d'utilisation du site WordPress.<br>
                                <br>
                                <strong>Réalisations :</strong> personnaliser et installer un thème WordPress, création d'une documentation pour les utilisateurs, proposition d'une solution technique.<br>
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 5-->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-labelledby="portfolioModal5Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal5Label">Blog PHP</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="/assets/img/portfolio/murat-can.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Pour ce projet, j'ai créé un blog PHP en démarrant de zéro. J'ai codé en PHP toutes la partie administration, pour administrer facilement le site Internet. J'ai également réalisé tous les diagrammes UML. <br>
                                <br>
                                <strong>Pour ce projet, j'ai utilisé :</strong> UML, PHP,  MYSQL, GitHub
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 6-->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-labelledby="portfolioModal6Label" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
            </button>
            <div class="modal-body text-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal6Label">ExpressFood</h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Image-->
                            <img class="img-fluid rounded mb-5" src="/assets/img/portfolio/expressFood.jpg" alt="" />
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-5">
                                Projet réalisé dans le cadre de ma formation développeur PHP. Pour ce projet, j'ai dû concevoir la solution technique pour une application de restauration en ligne.<br>
                                <br>
                                <strong>Technologie utilisée : </strong> WordPress.<br />
                                <strong>Réalisations :</strong> concevoir l'architecture technique, réalisé des schémas URL, implémenter le schéma de données dans la base.<br>
                                <strong>Pour ce projet, j'ai utilisé :</strong> UML, MYSQL.
                            </p>
                            <button class="btn btn-primary" data-dismiss="modal">
                                <i class="fas fa-times fa-fw"></i>
                                Fermer la fenêtre
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('layouts/default.php'); ?>
