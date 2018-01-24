<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Utils
{
     public static function curlNotifHelper($notifToken,$title,$body,$url){
         $notif = ["notification" => [
             "title" => $title,
             "body" => $body,
             "icon" => "https://overwatchteams.com/img/icon.png",
             "click_action" => $url
         ], "to" =>$notifToken];

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($notif));  //Post Fields
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

         $headers = [
             'Authorization: key=AAAA0WEW-CY:APA91bGvopMQZIo5qBTl4_fIcnGM2xeZLacjvtUPJhLvBiYXNlA5dV-PsuA1tJWdZ7XENoAm7dU0p3sYZxk6jjMYxPKdjs7awZoTIVK_7SdvYLcYWNUA3C4sYIQcPbwvTUFWdSGcPdP6',
             'Host: fcm.googleapis.com',
             'Content-Type: application/json',
             'Cache-Control: no-cache',

         ];

         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

         $server_output = curl_exec($ch);

         curl_close($ch);

         print  $server_output;
     }
}
