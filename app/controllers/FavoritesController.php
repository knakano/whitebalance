<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/6/14
 * Time: 8:19 AM
 */

use \Dropbox as dbx;

class FavoritesController extends BaseController {

    public function viewFavorites() {

        $accessToken = Auth::user()->accessToken;
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");

        $json2 = $dbxClient->getAccountInfo();

        $userFavorites = Auth::user()->favorites;
        $favorites = array();

        foreach ($userFavorites as $userFavorite) {
            array_push($favorites,
                DB::table('users')->where('id', $userFavorite->favorite_id)->first()->username);
        }

        return View::make('favorites', [
            'name' => $json2['display_name'],
            'username' => Auth::user()->username,
            'favorites' => $favorites
        ]);
    }

    public function addFavorite($username) {

        Favorite::create(array(
            'user_id' => Auth::user()->id,
            'favorite_id' => DB::table('users')->where('username', $username)->first()->id
        ));

        return Redirect::to('/favorites');
    }

    public function removeFavorite($username) {

        $favorite = DB::table('users')->where('username', $username)->first()->id;

        Favorite::where("favorite_id", '=', $favorite)
            ->where("user_id", '=', Auth::user()->id)
            ->get()
            ->first()
            ->delete();

        return Redirect::to('/favorites');
    }

} 