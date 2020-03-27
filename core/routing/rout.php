<?php
use core\App;

App::$collector->filter('auth', function(){
    if(!isset($_SESSION['username'])) {
        header('Location: /sign-in');
        die();
    }
});