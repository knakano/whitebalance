<?php
/**
 * Created by PhpStorm.
 * User: kalynnakano
 * Date: 5/4/14
 * Time: 3:21 PM
 */ ?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/foundation.css')?>" type="text/css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
    <script type="text/javascript" src="<?php echo asset('js/jquery-1.10.2.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/headroom.js')?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/freewall.js')?>"></script>
</head>
<body>
<header id="header">
        <?php if ((Auth::check()) && !$myProfile): ?>
            <div class="favorites">
            <a href="<?php echo url('/favorites')?>">My favorites</a>
                 //
                <?php if (!$favorited): ?>
                    <a href="<?php echo url('/favorites/add/'. $username)?>">Add</a>
                <?php else : ?>
                    <a href="<?php echo url('/favorites/remove/'. $username)?>">Remove</a>
                <?php endif; ?>
        <?php elseif ((Auth::check()) && $myProfile): ?>
            <div class="favorites">
            <a href="<?php echo url('/favorites')?>">My favorites</a>
        <?php else : ?>
            <div class="logo">
            <a href="<?php echo url('/')?>">White balance</a>
        <?php endif; ?>
         </div>
    <div class="user-info">
        <?php if (Auth::check()) : ?>
            <a href="/profile"><?php echo $loggedInUser; ?></a>
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
        <h3><?php echo $name; ?></h3>
    </div>
    <?php if (empty($photos)): ?>
        <div class="empty-state">
        <h3>We created a folder in your Dropbox.<br/>
            Manage your photos in the directory 'Apps/white balance' <br/>to view them with White Balance.</h3>
        </div>
    <?php endif ?>
    <div id="freewall" class="free-wall">
        <?php foreach ($photos as $photo):
            echo '<div class="brick">';
            echo '<img src="' . str_replace("www.dropbox", "dl.dropboxusercontent", $photo) . '" width="100%"/>';
            echo '</div>';
        endforeach;
        ?>
    </div>
</div>
</body>
<script type="text/javascript" src="//code.jquery.com/jquery-1.8.0.min.js"></script>
<script type="text/javascript">
    var wall = new freewall("#freewall");
    wall.reset({
        selector: '.brick',
        animate: true,
        cellW: 300,
        cellH: 'auto',
        onResize: function() {
            wall.fitWidth();
        }
    });

    wall.container.find('.brick img').load(function() {
        wall.fitWidth();
    });
</script>
<script type="text/javascript">
    var headroom = new Headroom(header, {
        "tolerance": 5,
        "offset": 205,
        "classes": {
            "initial": "animated",
            "pinned": "slideDown",
            "unpinned": "slideUp",
            "top": "headroom--top",
            "notTop": "headroom--not-top"
        }
    });
    headroom.init();
</script>
</html>