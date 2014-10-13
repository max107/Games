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
use Modules\Games\Models\Patch;

class PatchApi extends Api
{
    public $slug = 'url';

    public function getAllowedFields()
    {
        return ['id', 'name', 'description', 'game'];
    }

    /**
     * @return \Mindy\Orm\Model
     */
    public function getModel()
    {
        return new Patch;
    }
}
