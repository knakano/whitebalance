<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 4/29/14
 * Time: 8:01 AM
 */

use \Dropbox as dbx;

class LoginController extends BaseController {


    function getWebAuth()
    {
        session_start();
        $appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
        $clientIdentifier = "my-app/1.0";
        $redirectUri = "http://localhost:8000/auth";
        $csrfTokenStore = new dbx\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');
        return new dbx\WebAuth($appInfo, $clientIdentifier, $redirectUri, $csrfTokenStore, $userLocale = null);
    }

    public function displayHome() {
        return View::make('home');
    }

    public function startAuth()
    {
        $authorizeUrl = $this->getWebAuth()->start();
        return Redirect::to($authorizeUrl);
    }

    public function authorize() {
        try {
            list($accessToken, $userId, $urlState) = $this->getWebAuth()->finish($_GET);
            //echo($accessToken);
            assert($urlState === null);  // Since we didn't pass anything in start()
        }
        catch (dbx\WebAuthException_BadRequest $ex) {
            error_log("/dropbox-auth-finish: bad request: " . $ex->getMessage());
            // Respond with an HTTP 400 and display error page...
        }
        catch (dbx\WebAuthException_BadState $ex) {
            // Auth session expired.  Restart the auth process.
            header('Location: /dropbox-auth-start');
        }
        catch (dbx\WebAuthException_Csrf $ex) {
            error_log("/dropbox-auth-finish: CSRF mismatch: " . $ex->getMessage());
            // Respond with HTTP 403 and display error page...
        }
        catch (dbx\WebAuthException_NotApproved $ex) {
            error_log("/dropbox-auth-finish: not approved: " . $ex->getMessage());
        }
        catch (dbx\WebAuthException_Provider $ex) {
            error_log("/dropbox-auth-finish: error redirect from Dropbox: " . $ex->getMessage());
        }
        catch (dbx\Exception $ex) {
            error_log("/dropbox-auth-finish: error communicating with Dropbox API: " . $ex->getMessage());
        }

        //$client = dbx\Client($accessToken, ...);
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $json = $dbxClient->getAccountInfo();

        return View::make('signup', [
            'name' => $json['display_name'],
            'email' => $json['email'],
            'accessToken' => $accessToken
        ]);
    }

    public function createAccount() {

        $validation = User::validate(Input::all());

        if ($validation->passes()) {
            $user = new User;
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->accessToken = Input::get('accessToken');
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('/login')
                ->with('success', 'You successfully created an account');
        }

        else {
            return View::make('signup', [
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'accessToken' => Input::get('accessToken')
            ])->withErrors($validation);
        }
    }

    public function loginView() {
        return View::make('login');
    }

    public function login() {
        if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))){
            return Redirect::to('home');
        } else {
            return Redirect::to('/login')
                ->with('error', 'Your username or password was incorrect.');
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to("/login");
    }
 }