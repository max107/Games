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
 * @date 20/10/14.10.2014 13:26
 */

namespace Modules\Games\Forms;

use Mindy\Form\ManagedForm;
use Modules\Meta\Forms\MetaInlineForm;

class GameAdminForm extends ManagedForm
{
    /**
     * @return string form class
     */
    public function getFormClass()
    {
        return GameForm::className();
    }

    public function getInlines()
    {
        return [
            'meta' => MetaInlineForm::className(),
        ];
    }
}
