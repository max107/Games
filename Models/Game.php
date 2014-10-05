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
 * @date 05/10/14.10.2014 18:49
 */

namespace Modules\Games\Models;

use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\DateField;
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\ImageField;
use Mindy\Orm\Fields\ManyToManyField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;
use Modules\Games\GamesModule;

class Game extends Model
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
            'logo' => [
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
            'release_date' => [
                'class' => DateField::className(),
                'verboseName' => GamesModule::t('Release date')
            ],
            'website' => [
                'class' => CharField::className(),
                'verboseName' => GamesModule::t('Website')
            ],
            'platform' => [
                'class' => ForeignField::className(),
                'modelClass' => Platform::className(),
                'verboseName' => GamesModule::t('Platform')
            ],
            'developer' => [
                'class' => ForeignField::className(),
                'modelClass' => Developer::className(),
                'verboseName' => GamesModule::t('Developer')
            ],
            'publisher' => [
                'class' => ForeignField::className(),
                'modelClass' => Publisher::className(),
                'verboseName' => GamesModule::t('Publisher')
            ],
            'genre' => [
                'class' => ManyToManyField::className(),
                'modelClass' => Genre::className(),
                'verboseName' => GamesModule::t('Genre')
            ],
        ];
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}
