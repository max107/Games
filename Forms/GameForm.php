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
 * @date 20/10/14.10.2014 13:27
 */

namespace Modules\Games\Forms;

use Mindy\Form\ModelForm;
use Modules\Games\Models\Game;
use Modules\Meta\Forms\MetaInlineForm;

class GameForm extends ModelForm
{
    public function getModel()
    {
        return new Game;
    }

    public function getInlines()
    {
        return [
            ['meta' => MetaInlineForm::className()],
            ['game' => VideoInlineForm::className()]
        ];
    }
}
