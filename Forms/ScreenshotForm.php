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
 * @date 26/10/14.10.2014 20:28
 */

namespace Modules\Games\Forms;

use Mindy\Form\ModelForm;
use Modules\Games\Models\Screenshot;

class ScreenshotForm extends ModelForm
{
    public function getModel()
    {
        return new Screenshot;
    }
}