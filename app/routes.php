<?php

use \Dropbox as dbx;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::get('/dropbox', function(){

        $json = Cache::get('dropbox-wb');

        /*
         * AUTH FOR FUTURE
         *
         * $appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
         * $webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");
         *
         * $authorizeUrl = $webAuth->start();
         * echo "1. Go to: " . $authorizeUrl . "\n";
         * echo "2. Click \"Allow\" (you might have to log in first).\n";
         * print "1. Go to: " . $authorizeUrl . "\n";
         * $authCode = \trim(\readline("Enter the authorization code here: "));
         *
         * list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
         * print "Access Token: " . $accessToken . "\n";
        */
        if (!$json) {
            // For development, use my Dropbox access token
            $accessToken = "SBllbPfanCUAAAAAAAAATZpho78gn3IrZqTOmPp-PLQGl3F2Ft4z8uEU540zGr_M";
            $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
            //$accountInfo = $dbxClient->getAccountInfo();
            $json = $dbxClient->getAccountInfo();

            Cache::put('dropbox-wb', $json, 10);
        }

        //header('Content-type: application/json');
        dd($json);

});
