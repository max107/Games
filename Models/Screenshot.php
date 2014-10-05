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
 * @date 05/10/14.10.2014 20:02
 */

namespace Modules\Games\Models;

use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\ImageField;
use Mindy\Orm\Model;
use Modules\Games\GamesModule;

class Screenshot extends Model
{
    public static function getFields()
    {
        return [
            'file' => [
                'class' => ImageField::className(),
                'null' => true,
                'sizes' => [
                    'thumb' => [
                        160, 104,
                        'method' => 'adaptiveResizeFromTop',
                        'options' => ['jpeg_quality' => 5]
                    ],
                    'resize' => [
                        978
                    ],
                ],
                'verboseName' => GamesModule::t('Logo'),
            ],
            'game' => [
                'class' => ForeignField::className(),
                'verboseName' => GamesModule::t('Game'),
                'modelClass' => Game::className()
            ],
        ];
    }
}
