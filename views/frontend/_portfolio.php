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

        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Portfolio</h2>


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
