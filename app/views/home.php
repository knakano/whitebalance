<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/4/14
 * Time: 2:39 PM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/foundation.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
</head>
<body>
<header id="header">
<!--    <div class="inner">-->
        <div class="logo">White balance</div>
        <div class="user-info">
            <a href="/login">Log in</a>
            &nbsp; // &nbsp;
            <a href="/create-account">Sign Up</a></div>
<!--    </div>-->
</header>
<div class="main">
    <div class="inner">
        <h3>White Balance makes sharing photos beautiful and simple with Dropbox. </h3>
        <div class="center">
            <img class="screenshot" src="<?php echo asset('images/screenshot.png')?>"/>
        </div>
    </div>
</div>
<div class="row" style="text-align: center; padding-top: 60px; padding-bottom: 100px">
    <a href="/create-account" class="button"><img class="button-logo" src="<?php echo asset('images/dropbox-logo.png')?>">Sign Up with Dropbox</a>
</div>
</body>
</html>