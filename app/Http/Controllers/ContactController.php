<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Services\TelegramService;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{

    public function index()
    {
        return view('contact.contact');
    }

    public function store(Request $request, TelegramService $telegramService)
    {

        $name = $request->input('name');
        $csubject = $request->input('csubject');
        $cmessage = $request->input('cmessage');
        $filePath = public_path('admin/js/telegram.json');

        if (File::exists($filePath)) {
            $content = File::get($filePath);
            $data = json_decode($content, true);
            $messageTemplate = $data['messageContact'];
        } else {
            \Log::error('Telegram JSON file not found.');
            return false;
        }
        try {
            $message = str_replace(
                [
                    '{CUSTOMER_NAME}',
                    '{SUBJECT}',
                    '{MESSAGE}',
                    '{DATE_SUBMITTED}',
                ],
                [
                    $name,
                    $csubject,
                    $cmessage,
                    Carbon::now()->format('d-m-Y')
                ],
                $messageTemplate
            );

            $telegramService->sendMessage($message);
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Your message has been sent successfully! Thank you for reaching out.'
            ]);
        } catch (\Exception $e) {

            \Log::error('Error sending Telegram message: ' . $e->getMessage());

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'An error occurred while sending your message. Please try again later.'
            ]);
        }
    }
}
