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
 * @date 01/11/14.11.2014 19:01
 */

namespace Modules\Games\Forms;

use Mindy\Form\Fields\WysiwygField;
use Mindy\Form\ModelForm;
use Modules\Games\Models\Mod;

class ModForm extends ModelForm
{
    public function getFields()
    {
        return [
            'description' => [
                'class' => WysiwygField::className()
            ]
        ];
    }

    public function getModel()
    {
        return new Mod;
    }
}
