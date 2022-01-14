<?php 
namespace App\Services\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use View;

class MailService {

    public function sendCodeValidate($email,$code,$lastName,$view,$subject){

        try{

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host          = env('EMAIL_HOST'); 
            $mail->SMTPAuth      = true;
            $mail->Username      = env('EMAIL_USERNAME');                  
            $mail->Password      = env('EMAIL_PASSWORD'); 
            $mail->SMTPSecure    = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port          = 587;
           
            $mail->setFrom('aliagasport@gmail.com','My cms');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject       = $subject;
            $mail->Body          = $view->render();
            
            if($mail->send()){
                 $result = true;
                 return $result;
               
            }
        } catch (Exception $e) {
                $result = false;
                return $result;
        }
    }

    public function sendPasswordReset($email,$view,$subject){

        try{

        
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            
            $mail->Host          = env('EMAIL_HOST'); 
            $mail->SMTPAuth      = true;
            $mail->Username      = env('EMAIL_USERNAME');                  
            $mail->Password      = env('EMAIL_PASSWORD'); 
            $mail->SMTPSecure    = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port          = 587;
          
           
            $mail->setFrom('aliagasport@gmail.com','My cms');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject       = $subject;
            $mail->Body          = $view->render();
            
            if($mail->send()){
                 $result = true;
                 return $result;
               
            }
        } catch (Exception $e) {
                $result = false;
                return $result;
        }

    }

    public function sendEmailFromGmail($credentials,$to,$subject,$view){

        try{

        
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            
            $mail->Host          = 'smtp.gmail.com'; 
            $mail->SMTPAuth      = true;
            $mail->Username      = $credentials["email"];                  
            $mail->Password      = $credentials["password"];    
            $mail->SMTPSecure    = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port          = 587;
          
           
            $mail->setFrom('aliagasport@gmail.com','My cms');
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject       = $subject;
            $mail->Body          = $view->render();
            
            if($mail->send()){
                 $result = true;
                 return $result;
               
            }
        } catch (Exception $e) {
                $result = false;
                return $result;
        }

    }
}