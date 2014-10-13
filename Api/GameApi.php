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
 * @date 05/10/14.10.2014 21:34
 */

namespace Modules\Games\Api;

use Modules\Api\Components\Api;
use Modules\Games\Models\Game;

class GameApi extends Api
{
    /**
     * @var string
     */
    public $slug = 'slug';

    /**
     * @return array
     */
    public function getAllowedFields()
    {
        return [
            'id', 'name', 'slug', 'description', 'logo', 'release_date', 'website',
            'platform', 'developer',  'publisher', 'genre', 'patches', 'mods', 'videos',
            'screenshots'
        ];
    }

    /**
     * @return \Mindy\Orm\Model
     */
    public function getModel()
    {
        return new Game;
    }
}
