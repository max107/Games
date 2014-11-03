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

use Modules\Games\Models\Platform;
use Modules\Sitemap\Components\Sitemap;

/**
 * Class DeveloperSitemap
 * @package Modules\Games
 */
class PlatformSitemap extends Sitemap
{
    public function getModelClass()
    {
        return Platform::className();
    }

    public function getLoc($data)
    {
        return $this->reverse('games.platform_view', ['slug' => $data['slug']]);
    }
}
