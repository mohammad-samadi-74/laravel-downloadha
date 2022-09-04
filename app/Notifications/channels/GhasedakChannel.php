<?php


namespace App\Notifications\channels;


use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use Ghasedak\GhasedakApi;
use Illuminate\Notifications\Notification;

class GhasedakChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification,'userData'))
            throw new \Exception('متد userData پیدا نشد.');


        $receptor = $notification->userData($notifiable)['phone_number'];
        $message = $notification->userData($notifiable)['message'];

        try {
            $lineNumber = "10008566";
            $api = new GhasedakApi(config('services.ghasedak.api_key'));
            $api->SendSimple($receptor, $message, $lineNumber);
        } catch (ApiException $e) {
            echo $e->errorMessage();
        } catch (HttpException $e) {
            echo $e->errorMessage();
        }
    }
}
