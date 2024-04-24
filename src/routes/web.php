<?php

return [
    '/' => [app\Controllers\HomeController::class, 'index'],
    '/home' => [app\Controllers\HomeController::class, 'index'],
    '/users' =>[app\Controllers\UserController::class, 'index'],
    '/poll-types' =>[app\Controllers\PollTypeController::class, 'index'],
    '/poll-types/show' =>[app\Controllers\PollTypeController::class, 'show'],

];