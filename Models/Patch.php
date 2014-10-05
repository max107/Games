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
 * @date 05/10/14.10.2014 20:05
 */

namespace Modules\Games\Models;

use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\FileField;
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;
use Modules\Games\GamesModule;

class Patch extends Model
{
    public static function getFields()
    {
        return [
            'name' => [
                'class' => CharField::className(),
                'verboseName' => GamesModule::t('Name')
            ],
            'description' => [
                'class' => TextField::className(),
                'verboseName' => GamesModule::t('Description')
            ],
            'file' => [
                'class' => FileField::className(),
                'null' => true,
                'verboseName' => GamesModule::t('File'),
            ],
            'game' => [
                'class' => ForeignField::className(),
                'verboseName' => GamesModule::t('Game'),
                'modelClass' => Game::className()
            ],
        ];
    }
}
