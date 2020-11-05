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

<?= include '_portfolio.php'?>
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

