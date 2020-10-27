<?php


namespace App\Controller;


use AltoRouter;
use App\Connection;
use App\Model\Entity\User;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';

class HomeController
{
    private $router;
    private $pdo;
    private $id;
    private $slug;

    public function __construct(AltoRouter $router, ?array $params = [])
    {
        $this->router = $router;
        $this->pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');

        if ($params)
        {
            $this->id = (int)$params['id'];
            $this->slug = $params['slug'];
        }

    }

    function home()
    {
        $router = $this->router;


        require('../views/frontend/index.php');
    }

    function notFound()
    {
        require('../views/404.php');
    }

    function mail()
    {
        $router = $this->router;

        //Envoie de l'email
        if (!empty($_POST))
        {
            $messages = '<p>vous avez recu un message de : ' . $_POST['name'] . ' - ' . $_POST['email'] . ' - ' . $_POST['phone'] . ' - Voici son message : ' . $_POST['message'] . '</p>';

            $name = $_POST['name'];

            $mail = new PHPMailer();
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isSMTP();
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'murat49370@gmail.com';
            $mail->Password = 'vhuqllzpzamhdcll';
            $mail->setFrom($_POST['email'], $_POST['name']);
            $mail->addReplyTo('no-replyto@muratcan.fr', 'No-reply');
            $mail->addAddress('murat@boostclic.org', 'Murat');
            $mail->Subject = 'Vous avez recu une nouvelle demande';

            $mail->isHTML(true);
            $mail->msgHTML('tel : ' . $_POST['phone'] . ', message : ' . $_POST['message']);
            $mail->AltBody = 'This is a plain-text message body';

            $response = null;
            if (!$mail->send())
            {
                $response = 'errors';
                $_SESSION['flash']['error_mail'] = "Il y a ue un probléme sur l'envoie de du messsage. Merci de contacter un administrateur.";

            } else {
                $response = 'success';
                $_SESSION['flash']['success_mail'] = "Le message a bien été envoyer.";
                //dd($_SESSION['flash']['error_mail']);
            }

            $url = $router->generate('home') . '?response=' . $response;

            header('Location: ' . $url);


        }


    }


}