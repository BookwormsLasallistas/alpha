<?php 
include_once("../modulos/header.php");
include_once("../modulos/navbar.php");
include_once("../modulos/conexion.php");
?>
<link rel="stylesheet" href="../styles/login.css">
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../modulos/bibliotecas/PHPMailer/Exception.php';
require '../modulos/bibliotecas/PHPMailer/PHPMailer.php';
require '../modulos/bibliotecas/PHPMailer/SMTP.php';

if (isset($_POST['enviar'])){
    $correo = $_POST['correo'];

    $qry = "SELECT FROM usuarios WHERE correo = '$correo' AND status = 1"
    $resultado = mysqli_query($conn, $qry);

    if($resultado->num_rows > 0){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'user@example.com';                     //SMTP username
            $mail->Password   = 'secret';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('ellen@example.com');               //Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }else{

    }
}

?>
<body>
<div class="bg"></div>
    <div class="all">
        <div class="container-log" id="container">
            <div class="form-container sing-in">
                <form method="POST" action="">
                    <h1>Recuperar contraseña</h1>
                    <input type="email" id="correo" name="correo" placeholder="E-mail" required="required">
                    <button type="submit" name="enviar" href="">Enviar</button>
                </form> 
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
    <?php 
    include_once("../modulos/footer.php");
    ?>
</body>