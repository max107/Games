<?php

return [
    '' => [
        'name' => 'index',
        'callback' => '\Modules\Games\Controllers\GameController:index'
    ],
    'chat' => [
        'name' => 'chat',
        'callback' => '\Modules\Games\Controllers\ChatController:index'
    ],
    'genre' => [
        'name' => 'genre_list',
        'callback' => '\Modules\Games\Controllers\GenreController:list'
    ],
    'genre/{slug:[A-Za-z0-9-]+}' => [
        'name' => 'genre_view',
        'callback' => '\Modules\Games\Controllers\GenreController:view'
    ],

    'platforms' => [
        'name' => 'category',
        'callback' => '\Modules\Games\Controllers\PlatformController:list'
    ],
    'platforms/{slug:[A-Za-z0-9-]+}' => [
        'name' => 'platform_view',
        'callback' => '\Modules\Games\Controllers\PlatformController:view'
    ],

    'publishers' => [
        'name' => 'publisher_list',
        'callback' => '\Modules\Games\Controllers\PublisherController:index'
    ],
    'publishers/{slug:[A-Za-z0-9-]+}' => [
        'name' => 'publisher_view',
        'callback' => '\Modules\Games\Controllers\PublisherController:view'
    ],

    'developers' => [
        'name' => 'developer_list',
        'callback' => '\Modules\Games\Controllers\DeveloperController:index'
    ],
    'developers/{slug:[A-Za-z0-9-]+}' => [
        'name' => 'developer_view',
        'callback' => '\Modules\Games\Controllers\DeveloperController:view'
    ],

    'game/{slug:[A-Za-z0-9-]+}' => [
        'name' => 'view',
        'callback' => '\Modules\Games\Controllers\GameController:view'
    ],

    'game/{slug:[A-Za-z0-9-]+}/post' => [
        'name' => 'post_list',
        'callback' => '\Modules\Games\Controllers\PostController:index'
    ],
    'game/{slug:[A-Za-z0-9-]+}/post/{pk:\d+}-{url:[A-Za-z0-9-]+}' => [
        'name' => 'post_view',
        'callback' => '\Modules\Games\Controllers\PostController:view'
    ],

    'game/{slug:[A-Za-z0-9-]+}/patch' => [
        'name' => 'patch_list',
        'callback' => '\Modules\Games\Controllers\PatchController:index'
    ],
    'game/{slug:[A-Za-z0-9-]+}/patch/{pk:\d+}' => [
        'name' => 'patch_view',
        'callback' => '\Modules\Games\Controllers\PatchController:view'
    ],

    'game/{slug:[A-Za-z0-9-]+}/mods' => [
        'name' => 'mod_list',
        'callback' => '\Modules\Games\Controllers\ModController:index'
    ],
    'game/{slug:[A-Za-z0-9-]+}/mods/{pk:\d+}' => [
        'name' => 'mod_view',
        'callback' => '\Modules\Games\Controllers\ModController:view'
    ],

    'game/{slug:[A-Za-z0-9-]+}/screenshot' => [
        'name' => 'screenshot_list',
        'callback' => '\Modules\Games\Controllers\ScreenshotController:list'
    ],

    'game/{slug:[A-Za-z0-9-]+}/video' => [
        'name' => 'video_list',
        'callback' => '\Modules\Games\Controllers\VideoController:list'
    ],
    'game/{slug:[A-Za-z0-9-]+}/video/{pk:\d+}' => [
        'name' => 'video_view',
        'callback' => '\Modules\Games\Controllers\VideoController:view'
    ],
];
