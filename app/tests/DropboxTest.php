<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/6/14
 * Time: 2:08 PM
 */

use \Dropbox as dbx;

class DropboxTest extends TestCase {

    public function test_get_account_info() {
        // Arrange
        $accessToken = 'SBllbPfanCUAAAAAAAAA1ZHvoEXcUHqD1EoF_Akk7j7ioEfy4UzCHT6FZHlzqbQO';

        // Act
        $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
        $json = $dbxClient->getAccountInfo();

        // Assert
        $this->assertEquals('Kalyn Nakano', $json['display_name']);
    }

    public function test_get_user_from_db() {
        // Arrange
        $username = 'kalyn';

        // Act
        $user = DB::table('users')->where('username', $username)->first();

        // Assert
        $this->assertEquals($username, $user->username);
    }
} 