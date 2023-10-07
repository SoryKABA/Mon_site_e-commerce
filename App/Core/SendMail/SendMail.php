<?php

namespace App\Core\SendMail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class SendMail extends PHPMailer {

    public function sendMail($to, string $message) {
        
        try {
            //Server settings
            $this->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->isSMTP();                                            //Send using SMTP
            $this->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->Username   = 'skabaisidk@groupeisi.com';                     //SMTP username
            $this->Password   = 'Sorykabaisi20';                               //SMTP password
            $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $this->setFrom('skabaisidk@groupeisi.com', 'Sory KABA');
            if (is_array($to)) {
                foreach ($to as $customer) {
                    
                    $this->addAddress($customer);     //Add a recipient
                }
            }else {
                $this->addAddress($to);
            }
            // $this->addAddress('ellen@example.com');               //Name is optional
            // $this->addReplyTo('info@example.com', 'Information');
            // $this->addCC('cc@example.com');
            // $this->addBCC('bcc@example.com');
        
            //Attachments
            // $this->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $this->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $this->isHTML(true);                                  //Set email format to HTML
            $this->Subject = 'Ici le sujet';
            $this->Body    = $message;
            //$this->AltBody = $message;
        
            $this->send();
            echo "<div class='alert alert-success m-2'>Message envoyé</div>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->ErrorInfo}";
        }
    }
    
}