<?php

use \Dropbox as dbx;

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

    public function viewMyProfile() {

        //$json = Cache::get('dropbox-wb');
        $accessToken = Auth::user()->accessToken;
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

        //
            $json = $dbxClient->getDelta(null, null);
            //Cache::put('dropbox-wb', $json, 10);
        //}

        $photos = array();
        $json2 = $dbxClient->getAccountInfo();

        foreach ($json['entries'] as $photo):
            array_push($photos, $dbxClient->createShareableLink($photo[0]));
        endforeach;

        return View::make('profile', [
            'myProfile' => true,
            'name' => $json2['display_name'],
            'favorited' => false,
            'loggedInUser' => Auth::user()->username,
            'username' => Auth::user()->username,
            'photos' => $photos
        ]);
    }

    public function viewUserProfile($username) {

        $user = DB::table('users')->where('username', $username)->first();
        $accessToken = $user->accessToken;
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

        $json = $dbxClient->getDelta(null, null);

        $photos = array();
        $json2 = $dbxClient->getAccountInfo();

        foreach ($json['entries'] as $photo):
            array_push($photos, $dbxClient->createShareableLink($photo[0]));
        endforeach;

        if (Auth::check()) {
            $loggedInUser = Auth::user()->username;
        }
        else {
            $loggedInUser = $user->username;
        }

        $username = $user->username;
        $favorites = array();

        if (Auth::check()) {
            $userFavorites = Auth::user()->favorites;

            foreach ($userFavorites as $userFavorite) {
                array_push($favorites,
                    DB::table('users')->where('id', $userFavorite->favorite_id)->first()->id);
            }
        }

        if (in_array($user->id, $favorites)) {
            $favorited = true;
        }

        else {
            $favorited = false;
        }


        return View::make('profile', [
            'loggedInUser' => $loggedInUser,
            'favorited' => $favorited,
            'myProfile' => false,
            'name' => $json2['display_name'],
            'username' => $username,
            'photos' => $photos
        ]);
    }

}