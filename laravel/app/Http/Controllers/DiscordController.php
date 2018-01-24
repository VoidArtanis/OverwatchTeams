<?php
/**
 * Created by PhpStorm.
 * User: Miyuru
 * Date: 9/21/2017
 * Time: 8:52 PM
 */

namespace App\Http\Controllers;


use App\Helpers\DiscordHelper;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscordController extends Controller
{
    public function sendMessageToChannel(Request $request)
    {
        $isSent = DiscordHelper::sendMessageToChannel($request->input('message'), $request->input('channelId'));
        return response()->json(['success' => $isSent]);
    }

    public function getChannelMessages(Request $request)
    {
        $messages = DiscordHelper::getChannelMessages($request->input('channelId'), $request->input('lastMessageId'));
        return response()->json(['messages' => $messages]);
    }

    public function createGuild(Request $request)
    {
        DiscordHelper::createGuild();
    }

    public function createChannel(Request $request)
    {
        DiscordHelper::createChannel($request->input('guildId'), DiscordHelper::randomString());
    }

    public function createChannelInvite(Request $request)
    {
        DiscordHelper::createChannelInvite($request->input('channelId'));
    }

    public function getGuildChannels(Request $request)
    {
        DiscordHelper::getGuildChannels($request->input('guildId'));
    }

    public function deleteChannel(Request $request)
    {
        DiscordHelper::deleteChannel($request->input('channelId'));
    }
    public function getGuilds(Request $request)
    {
        DiscordHelper::getGuilds();
    }

    public function userOAuthCallback(Request $request)
    {
        $code = $request->input('code');
        $scrimId = $request->input('state');

        $client = new Client();
        $res = $client->request('POST', env('DISCORD_BASE_URL').'/oauth2/token', [
            'form_params' => [
                'client_id'=> env('DISCORD_CLIENT_ID'),
                'client_secret' => env('DISCORD_CLIENT_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('DISCORD_OAUTH_REDIRECT_URL'),
            ],
            'headers' => [
                'Content-Type'=> 'application/x-www-form-urlencoded'
            ]
        ]);
        $statusCode = $res->getStatusCode();
        if($statusCode == 200) {
            $accessTokenResponse = json_decode($res->getBody()->getContents(), true);
            $authUser = Auth::user();
            $user = User::find($authUser->id);
            $user->discordAccessToken = $accessTokenResponse['access_token'];
            $user->discordRefreshToken = $accessTokenResponse['refresh_token'];
            $user->save();
            return \redirect(route('teamscrim').'?id=' . $scrimId);
        }else{
            return ['error'=> $statusCode];
        }
    }
}