<?php
/**
 * Created by PhpStorm.
 * User: Miyuru
 * Date: 9/21/2017
 * Time: 8:00 PM
 */

namespace App\Helpers;


use GuzzleHttp\Client;

class DiscordHelper
{

    static function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    static function getHeaders(){
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bot ' . env('DISCORD_BOT_TOKEN')
        ];
    }

    public static function sendMessageToChannel($message, $channelId)
    {
        $client = new Client();
        $res = $client->request('POST', env('DISCORD_BASE_URL').'/channels/'.$channelId.'/messages', [
            'headers' => self::getHeaders(),
            'json' => [
                'content'=> $message
            ],
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            return true;
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function getChannelMessages($channelId, $lastMessageId = null)
    {
        $queryParams = $lastMessageId ? ['after' => $lastMessageId] : [];

        $client = new Client();
        $res = $client->request('GET', env('DISCORD_BASE_URL').'/channels/'.$channelId.'/messages', [
            'headers' => self::getHeaders(),
            'query' => $queryParams
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $messages = json_decode($res->getBody()->getContents(), true);
            return $messages;
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function createChannelForScrim($name){
        $guilds = self::getGuilds();
        foreach ($guilds as $guild){
            $guildId = $guild['id'];
            $channels = self::getGuildChannels($guildId);
            if(count($channels)<100){
                return self::createChannel($guildId, $name);
            }
        }
        $newGuild = self::createGuild();
        $guildId = $newGuild['id'];
        if($guildId){
            return self::createChannel($guildId, $name);
        }
        return false;
    }

    public static function deleteChannel($channelId){
        $client = new Client();
        $res = $client->request('DELETE', env('DISCORD_BASE_URL').'/channels/'.$channelId, [
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $deletedChannel = json_decode($res->getBody()->getContents(), true);
            return ['deletedChannel' => $deletedChannel];
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function getGuilds(){
        $client = new Client();
        $res = $client->request('GET', env('DISCORD_BASE_URL').'/users/@me/guilds', [
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $guilds = json_decode($res->getBody()->getContents(), true);
            return $guilds;
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function getGuildChannels($guildId){
        $client = new Client();
        $res = $client->request('GET', env('DISCORD_BASE_URL').'/guilds/'.$guildId.'/channels', [
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $channels = json_decode($res->getBody()->getContents(), true);
            return $channels;
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function createChannelInvite($channelId){
        $client = new Client();
        $res = $client->request('POST', env('DISCORD_BASE_URL').'/channels/'.$channelId.'/invites', [
            'json' => [
                'max_age'=> 86400,
                'max_uses' => 12
            ],
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $newInvite = json_decode($res->getBody()->getContents(), true);
            return ['code'=>$newInvite['code']];
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function createChannel($guildId, $name){
        $client = new Client();
        $res = $client->request('POST', env('DISCORD_BASE_URL').'/guilds/'.$guildId.'/channels', [
            'json' => [
                'name'=> $name,
                'type' => 0
            ],
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 201) {
            $newChannel = json_decode($res->getBody()->getContents(), true);
            return ['id'=>$newChannel['id']];
        }else{
            return 'error - status code - ' . $statusCode;
        }
    }

    public static function createGuild(){

        $client = new Client();
        $res = $client->request('POST', env('DISCORD_BASE_URL').'/guilds', [
            'json' => [
                'name'=> self::randomString(),
                'verification_level' => 0
            ],
            'headers' => self::getHeaders()
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 201) {
            $newGuild = json_decode($res->getBody()->getContents(), true);
            return ['id'=>$newGuild['id']];
        }else{
            return ['error'=> $statusCode];
        }
    }
}