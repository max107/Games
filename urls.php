<?php

return [
    '' => [
        'name' => 'index',
        'callback' => '\Modules\Games\Controllers\GameController:index'
    ],
    'category' => [
        'name' => 'category',
        'callback' => '\Modules\Games\Controllers\GameController:category'
    ],
    'genre/{slug:\w+}' => [
        'name' => 'category',
        'callback' => '\Modules\Games\Controllers\GameController:category'
    ],
    '{slug:\w+}' => [
        'name' => 'view',
        'callback' => '\Modules\Games\Controllers\GameController:view'
    ],
    '{slug:\w+}/blog' => [
        'name' => 'blog',
        'callback' => '\Modules\Games\Controllers\GameController:blog'
    ],
    '{slug:\w+}/blog/{pk:\d+}' => [
        'name' => 'blog_post',
        'callback' => '\Modules\Games\Controllers\GameController:blog_post'
    ],
];
