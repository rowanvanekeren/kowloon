<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mai;
use App\Models\Category;

use PHPMailer;
class EmailController extends Controller
{
    public function addSubscriber($locale, Request $request)
    {
        App::setLocale($locale);

        $exsist = $this->checkEmail($request->newsletter_email);

        if(!isset($exsist)){
        $saveEmail = $this->addEmail($request->newsletter_email,$locale);
            if($saveEmail){
               $email= $this->sendConfirmMail($request->newsletter_email);
                return $email;
            }else{
                return redirect(App::getLocale());
            }
        }else{
            return redirect(App::getLocale());
        }

    }

    public function checkEmail($email){
        $count = NewsletterSubscriber::where('email', '=', $email)->count();
        if($count == 0){
            return null;
        }else{
            return $count;
        }
    }
    public function addEmail($email,$locale){
        $newEmail = new NewsletterSubscriber([
           'email' => $email,
            'active' => 1,
            'locale_subscriber' => $locale
        ]);
        $saved = $newEmail->save();
        if($saved){
            return true;
        }else{
            return false;
        }
    }
    public function sendConfirmMail($email){
   $title = "Thanks for using Kowloon";
   $content= "you are now registerd on our newsletter on Kowloon";
        $categories = Category::with('translation')->get();
         Mail::send('email',['title' => $title, 'content' => $content, 'categories' => $categories], function ($message) use ($email)
        {

            $message->from('rowanvanekeren@hotmail.com', 'Kowloon');

            $message->to($email);

        });

        return response()->json(['message' => 'Request completed']);
    }
    public function sendConfirmMailPHPMailer($emailTo, $first_name){

        require(base_path().'/vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
        $mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

          //$mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'cocagiveaway@hotmail.com';                 // SMTP username
        $mail->Password = 'cocacola12';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->setFrom('cocagiveaway@hotmail.com', 'CocaCola');
        $mail->addAddress($emailTo, $first_name);     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->isHTML(false);                                  // Set email format to HTML

        $mail->Subject = 'Bedankt voor het registreren voor onze nieuwsbrief';
        $mail->Body    = 'Bedankt voor het registreren voor onze nieuwsbrief';
        $mail->AltBody = 'Bedankt voor het registreren voor onze nieuwsbrief';

        if(!$mail->send()) {

            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'success';
        }
    }
}
