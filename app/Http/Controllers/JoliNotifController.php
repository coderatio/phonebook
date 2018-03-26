<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

class JoliNotifController extends Controller
{
    public function showNotif()
    {
        // Create a Notifier
        $notifier = NotifierFactory::create();

// Create your notification
        $notification =
            (new Notification())
                ->setTitle('Notification title')
                ->setBody('This is the body of your notification')
                ->addOption('subtitle', 'This is a subtitle') // Only works on macOS (AppleScriptNotifier)
                ->addOption('sound', 'Frog') // Only works on macOS (AppleScriptNotifier)
        ;

// Send it
        $notifier->send($notification);
    }
}
