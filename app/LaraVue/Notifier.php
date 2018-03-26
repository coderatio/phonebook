<?php
/**
 * Created by PhpStorm.
 * User: JOSIAH
 * Date: 3/23/2018
 * Time: 12:51 AM
 */

namespace App\LaraVue;


use Joli\JoliNotif\Notification;
use Joli\JoliNotif\NotifierFactory;

class Notifier
{

    public static function show($title = '', $body, $icon = '')
    {
        // Create a Notifier
        $notifier = NotifierFactory::create();

        if ($title == '') {
            $title = 'Notification';
        }

        if ($icon == '') {
            $icon = base_path('public/img/logo.png');
        }

        // Create your notification
        $notification = (new Notification())
            ->setTitle($title)
            ->setBody($body)
            ->setIcon($icon)
            ->addOption('subtitle', 'notify');

        // Send it
        return $notifier->send($notification);
    }

}