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
 * @date 05/10/14.10.2014 18:52
 */

namespace Modules\Games\Models;


use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\HasManyField;
use Mindy\Orm\Fields\SlugField;
use Mindy\Orm\Model;
use Modules\Games\GamesModule;

class Platform extends Model
{
    public static function getFields()
    {
        return [
            'name' => [
                'class' => CharField::className(),
                'verboseName' => GamesModule::t('Name')
            ],
            'slug' => [
                'class' => SlugField::className(),
                'verboseName' => GamesModule::t('Slug'),
                'unique' => true
            ],
            'games' => [
                'class' => HasManyField::className(),
                'verboseName' => GamesModule::t('Games'),
                'modelClass' => Game::className(),
                'editable' => false
            ],
        ];
    }

    public function __toString()
    {
        return (string) $this->name;
    }

    public function getAbsoluteUrl()
    {
        return $this->reverse('games.platform_view', ['slug' => $this->slug]);
    }
}
