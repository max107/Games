<?php
/**
 * 
 *
 * All rights reserved.
 * 
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 05/10/14.10.2014 18:47
 */

namespace Modules\Games;

use Mindy\Base\Module;

class GamesModule extends Module
{
    public function getMenu()
    {
        return [
            'name' => $this->getName(),
            'items' => [
                [
                    'name' => self::t('Games'),
                    'adminClass' => 'GameAdmin',
                ],
                [
                    'name' => self::t('Developers'),
                    'adminClass' => 'DeveloperAdmin',
                ],
                [
                    'name' => self::t('Platforms'),
                    'adminClass' => 'PlatformAdmin',
                ],
                [
                    'name' => self::t('Publishers'),
                    'adminClass' => 'PublisherAdmin',
                ],
                [
                    'name' => self::t('Genres'),
                    'adminClass' => 'GenreAdmin',
                ],
                [
                    'name' => self::t('Posts'),
                    'adminClass' => 'PostAdmin',
                ],
                [
                    'name' => self::t('Comments'),
                    'adminClass' => 'CommentAdmin',
                ],
                [
                    'name' => self::t('Screenshot'),
                    'adminClass' => 'ScreenshotAdmin',
                ],
                [
                    'name' => self::t('Video'),
                    'adminClass' => 'VideoAdmin',
                ]
            ]
        ];
    }
}
