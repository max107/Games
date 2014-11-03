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

use Modules\Games\Models\Developer;
use Modules\Sitemap\Components\Sitemap;

/**
 * Class DeveloperSitemap
 * @package Modules\Games
 */
class DeveloperSitemap extends Sitemap
{
    public function getModelClass()
    {
        return Developer::className();
    }

    public function getLastMod($data)
    {
        if (isset($data['updated_at'])) {
            $date = $data['updated_at'];
        } else {
            $date = $data['created_at'];
        }

        return $this->formatLastMod($date);
    }

    public function getLoc($data)
    {
        return $this->reverse('games.developer_view', ['slug' => $data['slug']]);
    }
}
