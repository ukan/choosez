<?php

namespace App\Listeners\Backend;

use Mail;
use Sentinel;
use App\Events\Backend\AdminAlertEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminAlertSender
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AdminAlertEvent  $event
     * @return void
     */
    public function handle(AdminAlertEvent $event)
    {
        // $user = $event->user;
        $data = Sentinel::getUser()->first_name;
        
        $find_data['email'] = "x";
        $find_data['id'] = "cek";
        $find_data['full_name'] = $data;
        $find_data['table'] = "Update Bulletin";

        Mail::queue('email.update_admin', $find_data, function($message) use($find_data) {
                            $message->from("noreply@alihsan.com", 'AL Ihsan No-Reply');
                            $message->to("ukan.job@gmail.com", $find_data['full_name'])->subject('Admin Update Content');
                        });
    }
}
