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
 * @date 19/10/14.10.2014 16:25
 */

namespace Modules\Games\Models;

use Mindy\Orm\Fields\ForeignField;
use Modules\Games\GamesModule;
use Modules\Reviews\Models\Review as ReviewBase;

class Review extends ReviewBase
{
    public static function getFields()
    {
        return array_merge(parent::getFields(), [
            'game' => [
                'class' => ForeignField::className(),
                'modelClass' => Game::className(),
                'verboseName' => GamesModule::t('Game')
            ],
        ]);
    }

    public function getAbsoluteUrl()
    {
        return $this->reverse('games.review_view', ['slug' => $this->slug, 'pk' => $this->pk]);
    }
}
