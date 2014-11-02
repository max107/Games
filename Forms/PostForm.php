<?php

namespace Modules\Games\Forms;

use Mindy\Form\Fields\TextAreaField;
use Mindy\Form\Fields\WysiwygField;
use Mindy\Form\ModelForm;
use Modules\Core\Fields\Form\TimeStampField;
use Modules\Games\GamesModule;
use Modules\Games\Models\Post;
use Modules\Meta\Forms\MetaInlineForm;

/**
 * Class PostForm
 */
class PostForm extends ModelForm
{
    public $exclude = ['comments'];

    public function __construct(array $config = [])
    {
        $this->configure($config);
        $this->init();
    }

    public function getFieldsets()
    {
        return [
            GamesModule::t('Main information') => [
                'name', 'url', 'content_short', 'content',
                'is_published', 'published_at', 'game'
            ],
            GamesModule::t('Comments settings') => [
                'enable_comments', 'enable_comments_form'
            ]
        ];
    }

    public function getFields()
    {
        return [
            'published_at' => [
                'class' => TimeStampField::className(),
                'autoNow' => true,
                'label' => GamesModule::t('Published time')
            ],
            'content_short' => [
                'class' => TextAreaField::className(),
                'label' => GamesModule::t('Short content')
            ],
            'content' => [
                'class' => WysiwygField::className(),
                'label' => GamesModule::t('Content')
            ],
        ];

    }

    public function getInlines()
    {
        return [
            ['meta' => MetaInlineForm::className()]
        ];
    }

    public function getModel()
    {
        return Post::className();
    }
}
