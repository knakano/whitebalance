<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 4/29/14
 * Time: 10:49 AM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/foundation.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
</head>
<body>
<header id="header">
    <!--    <div class="inner">-->
    <div class="logo"><a href="<?php echo url('/')?>">White balance</a></div>
    <div class="user-info">
       <a href="/create-account">Sign Up With Dropbox</a></div>
    <!--    </div>-->
</header>
<div class="main">
    <div class="inner">
        <div class="small-4 large-4 small-centered large-centered columns">
            <h1>Login</h1>
            <form class="login-form" method="post" action="<?php echo url('login')?>">
                <?php if (count($errors->all())) : ?>
                    <div class="error-message">
                        <?php foreach ($errors->all() as $error) : ?>
                            <?php echo $error; ?> <br/>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <?php if (Session::has("error")) : ?>
                    <div class="error-message">
                        <?php echo Session::get("error"); ?>
                    </div>
                <?php elseif (Session::has("success")) : ?>
                    <div class="success-message">
                        <?php echo Session::get("success"); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <label>Username</label>
                    <input type="text" name="username"/>
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" name="password"/>
                </div>
                <div class="center">
                    <input class="button button-short" type="submit" value="Log In" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>