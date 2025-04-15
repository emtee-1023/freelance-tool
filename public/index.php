<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

if (file_exists('/home/youruser/laravel-app/vendor/autoload.php')) {
    require '/home/youruser/laravel-app/vendor/autoload.php';
    $app = require_once '/home/youruser/laravel-app/bootstrap/app.php';
} else {
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
}

$app->handleRequest(Request::capture());
