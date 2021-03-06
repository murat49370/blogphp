<?php


namespace App\Controller;



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';


class HomeController extends Controller
{

    function home()
    {
        $router = $this->router;

        $title = 'Développeur PHP / Symfony - Murat CAN';
        return $this->view->render($title,'frontend/index.php', [
            'router' => $router
        ]);
    }


    function notFound()
    {
        require('../views/404.php');
    }

    function mail()
    {
        $router = $this->router;

        //Send Email
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
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = GMAIL_USERNAME;
            $mail->Password = GMAIL_PASSWORD;
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
            }

            $url = $router->generate('home') . '?response=' . $response;

            //header('Location: ' . $url);
            echo '<script language="javascript" type="text/javascript"> window.location.href = \'/?response=success\';</script>';

        }

    }

}
