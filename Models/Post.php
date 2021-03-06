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
 * @date 05/10/14.10.2014 19:30
 */

namespace Modules\Games\Models;

use Mindy\Base\Mindy;
use Mindy\Orm\Fields\BooleanField;
use Mindy\Orm\Fields\CharField;
use Mindy\Orm\Fields\DateTimeField;
use Mindy\Orm\Fields\ForeignField;
use Mindy\Orm\Fields\HasManyField;
use Mindy\Orm\Fields\SlugField;
use Mindy\Orm\Fields\TextField;
use Mindy\Orm\Model;
use Modules\Games\GamesModule;

/**
 * Class Page
 * @package Modules\Pages
 * @method static \Modules\Pages\Models\PageManager objects($instance = null)
 */
class Post extends Model
{
    public $metaConfig = [
        'title' => 'name',
        'keywords' => 'content',
        'description' => 'content_short'
    ];

    public static function getFields()
    {
        $fields = [
            'name' => [
                'class' => CharField::className(),
                'required' => true,
                'verboseName' => GamesModule::t('Name')
            ],
            'url' => [
                'class' => SlugField::className(),
                'verboseName' => GamesModule::t('Url'),
                'unique' => true
            ],
            'content' => [
                'class' => TextField::className(),
                'null' => true,
                'verboseName' => GamesModule::t('Content')
            ],
            'content_short' => [
                'class' => TextField::className(),
                'null' => true,
                'verboseName' => GamesModule::t('Short content')
            ],
            'game' => [
                'class' => ForeignField::className(),
                'modelClass' => Game::className(),
                'verboseName' => GamesModule::t('Game')
            ],
            'created_at' => [
                'class' => DateTimeField::className(),
                'autoNowAdd' => true
            ],
            'updated_at' => [
                'class' => DateTimeField::className(),
                'autoNow' => true
            ],
            'published_at' => [
                'class' => DateTimeField::className(),
                'null' => true
            ],
            'is_published' => [
                'class' => BooleanField::className(),
                'verboseName' => GamesModule::t('Is published'),
                'default' => true
            ],
            'enable_comments' => [
                'class' => BooleanField::className(),
                'verboseName' => GamesModule::t('Enable comments'),
                'default' => true
            ],
            'enable_comments_form' => [
                'class' => BooleanField::className(),
                'verboseName' => GamesModule::t('Enable comments form'),
                'default' => true
            ],
        ];

        $app = Mindy::app();
        if ($app->hasModule('Comments') && $app->getModule('Blog')->enableComments) {
            $fields['comments'] = [
                'class' => HasManyField::className(),
                'modelClass' => Comment::className()
            ];
        }
        return $fields;
    }

    public function __toString()
    {
        return (string)$this->name;
    }

    public static function objectsManager($instance = null)
    {
        $className = get_called_class();
        return new PostManager($instance ? $instance : new $className);
    }

    public function getAbsoluteUrl()
    {
        return $this->reverse('games.post_view', [
            'slug' => $this->game->slug,
            'pk' => $this->pk,
            'url' => $this->url
        ]);
    }
}
