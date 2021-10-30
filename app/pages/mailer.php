<?php
require __DIR__.'/vendor/autoload.php';
// scp -i ~/.ssh/Staging.pem -r * ubuntu@18.219.150.157:/home/admin/web/staging2.fabrica-dev.com/public_html/veloaero
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$name = $_POST["name"];
$email = $_POST["email"];
$address = $_POST["address"];
$details = $_POST["details"];
 
$EmailTo = "aya.ironlady@seasplit.com";
$Subject = "Message from " . $name;
// prepare email body text
$Body = "Name: ";
$Body .= $name;
$Body .= "\n";
 
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
 
$Body .= "Phone Number: ";
$Body .= $address;
$Body .= "\n";
 
$Body .= "Request: ";
$Body .= $details;
$Body .= "\n";
try {
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.fabrica-dev.com';                 //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'hossam@fabrica-dev.com';                     //SMTP username
    $mail->Password   = '7946138520hossam';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable SSL encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($mail->Username, 'Landing Page');
    $mail->addAddress($EmailTo, 'Hossam Mohsen');     //Add a recipient
    //Content
    //$mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = $Body;

    $response = $mail->send();
    setcookie('success','true');
} catch (\Throwable $exception) {
    setcookie('success','false');
}
header("Location: /veloaero");

//// send email
//$success = mail($EmailTo, $Subject, $Body, "From:".$email);
//
//// redirect to success page

exit();
?>