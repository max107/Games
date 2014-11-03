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

use Modules\Games\Models\Post;
use Modules\Sitemap\Components\Sitemap;

/**
 * Class DeveloperSitemap
 * @package Modules\Games
 */
class PostSitemap extends Sitemap
{
    public function getModelClass()
    {
        return Post::className();
    }

    /**
     * Return query set object
     * @return \Mindy\Orm\QuerySet
     */
    public function getQuerySet()
    {
        return $this->getModel()->objects()->with(['game']);
    }

    public function getLoc($data)
    {
        return $this->reverse('games.post_view', [
            'slug' => $data['game']['slug'],
            'pk' => $data['id'],
            'url' => $data['url']
        ]);
    }
}
