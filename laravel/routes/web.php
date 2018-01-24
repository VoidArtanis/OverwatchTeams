<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  'CommonController@index');

/*
 * Logins
 */
Route::get('battleNet', 'Auth\Social\AuthController@redirectToProvider_BattleNet')->name('battleNetLogin');
Route::get('battleNet/callback', 'Auth\Social\AuthController@handleProviderCallback_BattleNet');

Route::get('/logout', 'CommonController@logout')->name('logout');

Route::get('/login','CommonController@login')->name('login');

/*
 * Profile
 */
Route::get('/profile', 'ProfileController@index' )->name('profile');
Route::get('/profile-req', 'ProfileController@profileRequest' )->name('profile-req');
Route::get('/profile-acpt', 'ProfileController@profileAccept' )->name('profile-acpt');
Route::get('/search', 'SearchController@index' )->name('search');
Route::get('/requests', 'ProfileController@showRequests' )->name('requests');
Route::get('/registerfill', 'ProfileController@registerFill' )->name('registerFill')->middleware('auth');
Route::post('/regfillpost', 'ProfileController@regFillPost' )->name('regfillpost');
Route::get('/regfillskip', 'ProfileController@regfillSkip' )->name('regfillskip');
Route::get('/editprofile', 'ProfileController@editProfile' )->name('editprofile')->middleware('auth');
Route::post('/editprofilepost', 'ProfileController@editProfilePost' )->name('editprofilepost');
Route::get('/matches', 'ProfileController@getMatches' )->name('matches');


Route::post('/notiftokensave', 'NotificationController@saveToken' )->name('notifSave');

/*
 * Top Stuff
 */
Route::get('/topteams', 'TopTeamsController@index' )->name('topteams');
Route::get('/topplayers', 'TopPlayersController@index' )->name('topplayers');

/*
 * Teams
 */
Route::get('/teams/reg', 'TeamsController@registerindex' )->name('teamreg')->middleware('auth');;
Route::post('/teams/regpost', 'TeamsController@register' )->name('teamregpost');
Route::get('/teams/myteams', 'TeamsController@myteams' )->name('myteams')->middleware('auth');
Route::get('/teams', 'TeamsController@team' )->name('team');
Route::get('/teams/confirm', 'TeamsController@confirm' );
Route::get('/teams/accept', 'TeamsController@confirm' )->name('team-acpt');
Route::get('/teams/useraccept', 'TeamsController@confirmUser' )->name('team-acpt-user');
Route::get('/teams/userreject', 'TeamsController@rejectUser' )->name('team-reject-user');
Route::get('/teams/edit', 'TeamsController@edit' )->name('team-edit')->middleware('auth');
Route::get('/teams/delete', 'TeamsController@delete' )->name('team-delete');
Route::post('/teams/editPost', 'TeamsController@editPost' )->name('teameditpost');
Route::get('/teams/top', 'TopTeamsController@index' )->name('topTeams');


/*
 * Patchers
 */
Route::get('/patcher', 'PatchController@index' );
Route::get('/cycle', 'PatchController@cycle' );

/*
 * Get Started
 */
Route::get('/get-started','CommonController@getStarted')->name('getstarted');

/*
 * Scrims
 */
Route::get('/teamscrim','ScrimController@index')->name('teamscrim');
Route::get('/scrimschedule','ScrimController@schedule')->name('scrimschedule');
Route::post('/scrimschedulepost','ScrimController@schedulePost')->name('scrimschedule-post');
Route::get('/scrimaccept','ScrimController@scrimAccept')->name('scrimaccept');

/*
 * Discord
 */
if (App::environment('local')) {
    Route::get('/discord/createGuild', 'DiscordController@createGuild')->name('discord-create-guild');
    Route::get('/discord/getGuilds', 'DiscordController@getGuilds')->name('discord-get-guilds');
    Route::get('/discord/getGuildChannels', 'DiscordController@getGuildChannels')->name('discord-get-guild-channels');
    Route::get('/discord/createChannel', 'DiscordController@createChannel')->name('discord-create-channel');
    Route::get('/discord/createChannelInvite', 'DiscordController@createChannelInvite')->name('discord-create-channel-invite');
    Route::get('/discord/deleteChannel', 'DiscordController@deleteChannel')->name('discord-delete-channel');
}

Route::get('/discord/getChannelMessages','DiscordController@getChannelMessages')->name('discord-get-channel-messages');
Route::post('/discord/sendMessageToChannel','DiscordController@sendMessageToChannel')->name('discord-send-message-to-channel');
Route::get('/discord/userOAuthCallback','DiscordController@userOAuthCallback')->name('discord-user-oauth-callback');