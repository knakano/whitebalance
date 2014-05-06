<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 4/29/14
 * Time: 7:10 AM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
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
        <a href="/login">Log In</a></div>
    <!--    </div>-->
</header>
<div class="main">
    <div class="inner">
        <div class="small-4 large-4 small-centered large-centered columns">
            <h1>Create Account</h1>
            <form class="login-form" method="post" action="<?php echo url('signup-process')?>">
                <?php if (count($errors->all())) : ?>
                    <div class="error-message">
                        <?php foreach ($errors->all() as $error) : ?>
                            <?php echo $error; ?> <br/>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <div>
                    <label>Name:</label>
                    <input type="text" name="name" placeholder="<?php echo $name;?>" value="<?php echo $name;?>"/>
                </div>
                <div>
                    <label>Email:</label>
                    <input type="text" name="email" placeholder="<?php echo $email;?>" value="<?php echo $email;?>"/>
                </div>
                <div style="display: none;">
                    <label>Dropbox Access Token:</label>
                    <input type="text" name="accessToken" placeholder="<?php echo $accessToken;?>" value="<?php echo $accessToken;?>"/>
                </div>
                <div>
                    <label>White Balance username:</label>
                    <input type="text" name="username"/>
                </div>
                <div>
                    <label>White Balance password:</label>
                    <input type="password" name="password"/>
                </div>
                <div class="center">
                    <input class="button button-short" type="submit" value="Create Account" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>