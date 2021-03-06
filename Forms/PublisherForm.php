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
 * @date 02/11/14.11.2014 13:16
 */

namespace Modules\Games\Forms;

use Mindy\Form\Fields\CharField;
use Mindy\Form\Fields\WysiwygField;
use Mindy\Form\ModelForm;
use Modules\Games\Models\Publisher;

class PublisherForm extends ModelForm
{
    public function getFields()
    {
        return [
            'name' => [
                'class' => CharField::className(),
            ],
            'description' => [
                'class' => WysiwygField::className(),
            ],
        ];
    }

    public function getModel()
    {
        return new Publisher;
    }
}
