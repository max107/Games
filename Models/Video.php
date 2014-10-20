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
 * @date 11/10/14.10.2014 14:10
 */

namespace Modules\Games\Models;

use Mindy\Orm\Fields\ForeignField;
use Modules\Games\GamesModule;
use Modules\Video\Models\Video as VideoBase;

class Video extends VideoBase
{
    public static function getFields()
    {
        return array_merge(parent::getFields(), [
            'game' => [
                'class' => ForeignField::className(),
                'modelClass' => Game::className(),
                'verboseName' => GamesModule::t('Game'),
                'editable' => false
            ]
        ]);
    }

    public function getAbsoluteUrl()
    {
        return $this->reverse('games.video_view', ['slug' => $this->game->slug, 'pk' => $this->pk]);
    }
}
