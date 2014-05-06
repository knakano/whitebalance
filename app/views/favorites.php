<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/6/14
 * Time: 8:21 AM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <title>Favorites</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/foundation.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
    <script type="text/javascript" src="<?php echo asset('js/jquery-1.10.2.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/headroom.js')?>"></script>
</head>
<body>
<header id="header">
    <?php if (Auth::check()) : ?>
    <div class="favorites">
        <a href="<?php echo url('/favorites')?>">My favorites</a>
        <?php else : ?>
        <div class="logo">
            <a href="<?php echo url('/')?>">White balance</a>
            <?php endif; ?>
        </div>
        <div class="user-info">
            <?php if (Auth::check()) : ?>
            <a href="/profile"><?php echo $username; ?></a>
            &nbsp; // &nbsp;
            <a href="/logout">Log out</a></div>
        <?php else : ?>
        <a href="/login">Log in</a>
        &nbsp; // &nbsp;
        <a href="/">Sign Up</a></div>
<?php endif; ?>
</header>
<div class="row">
    <div class="profile">
        <h3>Your Favorites</h3>
        <div id="favorites">
        <?php foreach ($favorites as $favorite):
            echo '<a href="/user/' . $favorite . '">' . $favorite . '</a><br/>';
        endforeach; ?>
        </div>
    </div>


</div>
</body>