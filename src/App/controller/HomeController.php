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
            $message = 'vous avez recu un message de : ' . $_POST['name'] . ' - ' . $_POST['email'] . ' - ' . $_POST['phone'] . ' - Voici son message : ' . $_POST['message'];

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
            $mail->Username = GMAIL_USERNAME;
            $mail->Password = GMAIL_PASSWORD;
            $mail->setFrom('murat49370@gmail.com', 'Blog Website');
            $mail->addReplyTo('no-replyto@muratcan.fr', 'No-reply');
            $mail->addAddress('murat@boostclic.org', 'Murat');
            $mail->Subject = 'Vous avez recu une nouvelle demande';

            $mail->msgHTML($message);
            $mail->AltBody = 'This is a plain-text message body';

            $response = null;
            if (!$mail->send())
            {
                $response = 'errors';
                //$_SESSION['flash']['error_mail'] = "Il y a ue un probléme sur l'envoie de du messsage. Merci de contacter un administrateur.";
                //echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                $response = 'success';
            }

        }
        //exit(header('Location:/?response=' . $response));
        //echo("<script>location.href = '/?response=$response';</script>");
        ?><script><?php echo("location.href = '/?response=$response';");?></script><?php



    }


}