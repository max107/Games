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
use Mindy\Orm\Fields\DateTimeField;
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\HasManyField;
use Mindy\Orm\Fields\ImageField;
use Mindy\Orm\Fields\ManyToManyField;
use Mindy\Orm\Fields\SlugField;
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
            'slug' => [
                'class' => SlugField::className(),
                'verboseName' => GamesModule::t('Slug'),
                'unique' => true
            ],
            'description' => [
                'class' => TextField::className(),
                'verboseName' => GamesModule::t('Description')
            ],
            'logo' => [
                'class' => ImageField::className(),
                'null' => true,
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
                'class' => ManyToManyField::className(),
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
            'patches' => [
                'class' => HasManyField::className(),
                'modelClass' => Patch::className(),
                'verboseName' => GamesModule::t('Patches'),
                'editable' => false
            ],
            'mods' => [
                'class' => HasManyField::className(),
                'modelClass' => Mod::className(),
                'verboseName' => GamesModule::t('Modifications'),
                'editable' => false
            ],
            'screenshots' => [
                'class' => HasManyField::className(),
                'modelClass' => Screenshot::className(),
                'verboseName' => GamesModule::t('Screenshots'),
                'editable' => false
            ],
            'videos' => [
                'class' => HasManyField::className(),
                'modelClass' => Video::className(),
                'verboseName' => GamesModule::t('Videos'),
                'editable' => false
            ],
            'posts' => [
                'class' => HasManyField::className(),
                'modelClass' => Post::className(),
                'verboseName' => GamesModule::t('Posts'),
                'editable' => false
            ],
            'created_at' => [
                'class' => DateTimeField::className(),
                'autoNowAdd' => true,
                'editable' => false
            ],
            'updated_at' => [
                'class' => DateTimeField::className(),
                'autoNow' => true,
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
        return $this->reverse('games.view', ['slug' => $this->slug]);
    }
}
