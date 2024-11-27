<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PhpMailerService;

class SendMailController extends Controller
{
    // $email, $title, $content
    public function sendTestEmail($email, $title, $content)
    {
        $to = $email;
        $subject = $title;
        $body = $content;

        $result = PhpMailerService::sendEmail($to, $subject, $body);

        // if ($result === true) {
        //     return 'Email sent successfully!';
        // } else {
        //     return $result;
        // }
    }
}
