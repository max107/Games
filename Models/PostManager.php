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
 * @date 07/10/14.10.2014 14:22
 */

namespace Modules\Games\Models;

use Mindy\Orm\Manager;

class PostManager extends Manager
{
    public function published()
    {
        $this->filter(['is_published' => true]);
        return $this;
    }
}
