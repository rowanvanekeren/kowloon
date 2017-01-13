<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class EmailController extends Controller
{
    public function addSubscriber($locale, Request $request)
    {
        App::setLocale($locale);

        $exsist = $this->checkEmail($request->newsletter_email);

        if(!isset($exsist)){
        $saveEmail = $this->addEmail($request->newsletter_email,$locale);
        }

    }

    public function checkEmail($email){
        $count = NewsletterSubscriber::where('email', '=', $email)->get();
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
            'locale' => $locale
        ]);
        $saved = $newEmail->save();
        if($saved){
            return $email;
        }else{
            return null;
        }
    }
    public function sendConfirmMail(){

    }
}
