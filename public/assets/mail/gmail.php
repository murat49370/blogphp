<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../../../vendor/autoload.php';

$message = 'vous avez recu un message de : ' . $_POST['name'] . ' - ' . $_POST['email'] . ' - ' . $_POST['phone'] . ' - Voici son message : ' . $_POST['message'];

//Create a new PHPMailer instance
$mail = new PHPMailer();

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'murat49370@gmail.com';

//Password to use for SMTP authentication
$mail->Password = 'mzsymvbrcxtvihqn';

//Set who the message is to be sent from
$mail->setFrom('murat49370@gmail.com', 'Blog Murat CAN');

//Set an alternative reply-to address
$mail->addReplyTo('no-replyto@muratcan.fr', 'No-reply');

//Set who the message is to be sent to
$mail->addAddress('murat@boostclic.org', 'Murat');

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$message = 'vous avez recu un message de : ' . $_POST['name'] . ' - ' . $_POST['email'] . ' - ' . $_POST['phone'] . ' - Voici son message : ' . $_POST['message'];
$mail->msgHTML('test');

//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//Attach an image file

//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    $_SESSION['flash']['error_mail'] = "Il y a ue un probléme sur l'envoie de du messsage. Merci de contacter un administrateur.";
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $_SESSION['flash']['success_mail'] = "Le message à bien été envoyer !";
    //echo 'Message sent!';
}

function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
header('Location: /' );