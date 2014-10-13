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
 * @date 11/10/14.10.2014 14:14
 */

namespace Modules\Games\Admin;

use Modules\Games\Models\Video;
use Modules\Video\Admin\VideoAdmin as VideoBaseAdmin;

class VideoAdmin extends VideoBaseAdmin
{
    /**
     * @return \Mindy\Orm\Model
     */
    public function getModel()
    {
        return new Video;
    }
}
