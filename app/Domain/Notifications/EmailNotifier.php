<?php namespace App\Domain\Notifications;

use Illuminate\Support\Facades\Mail;

class EmailNotifier {


    public function notifyOfLowInventory($email, $stats)
    {

        Mail::send('emails.lowInventory', ['notifications' => $stats], function($message) use ($email)
        {
            $message->to($email->address)
                ->subject('Low Inventory Notification');
        });


        //return view('emails.lowInventory', ['notifications' => $stats]);

    }

}