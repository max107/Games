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
 * @date 20/10/14.10.2014 13:28
 */

namespace Modules\Games\Forms;

use Mindy\Form\InlineModelForm;
use Modules\Games\Models\Video;

class VideoInlineForm extends InlineModelForm
{
    public function getModel()
    {
        return new Video;
    }
}
