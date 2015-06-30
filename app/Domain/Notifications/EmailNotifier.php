<?php namespace App\Domain\Notifications;

use Illuminate\Support\Facades\Mail;

class EmailNotifier {


    public function notifyOfLowInventory($email, $stats)
    {$data = [];


        $test = Mail::raw('Text to e-mail', function($message)
        {
            $message->from('us@example.com', 'Laravel');

            $message->to('simon-flachs@hotmail.com')->subject('test');
        });

        $sent = Mail::send('emails.lowInventory', $data, function($message) use ($email)
        {
            $message->to($email->address)
                ->subject('Low Inventory Notification');
        });

        dd(Mail::failures());
        //return view('emails.lowInventory', ['notifications' => $stats]);

    }

}