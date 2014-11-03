<?php

/**
 * All rights reserved.
 *
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 03/07/14.07.2014 16:41
 */

namespace Modules\Games\Sitemap;

use Modules\Games\Models\Publisher;
use Modules\Sitemap\Components\Sitemap;

/**
 * Class DeveloperSitemap
 * @package Modules\Games
 */
class PublisherSitemap extends Sitemap
{
    public function getModelClass()
    {
        return Publisher::className();
    }

    public function getLoc($data)
    {
        return $this->reverse('games.publisher_view', ['slug' => $data['slug']]);
    }
}
