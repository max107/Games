<?php

namespace Modules\Games\Admin;

use Modules\Admin\Components\ModelAdmin;
use Modules\Games\Forms\PostAdminForm;
use Modules\Games\Models\Post;
use Modules\Games\GamesModule;

class PostAdmin extends ModelAdmin
{
    public function getColumns()
    {
        return ['id', 'name', 'published_at'];
    }

    public function getSearchFields()
    {
        return ['name'];
    }

    public function getCreateForm()
    {
        return PostAdminForm::className();
    }

    public function getModel()
    {
        return new Post;
    }

    public function getVerboseName()
    {
        return GamesModule::t('post');
    }

    public function getVerboseNamePlural()
    {
        return GamesModule::t('posts');
    }

    public function getActions()
    {
        return array_merge(parent::getActions(), [
            'publish' => GamesModule::t('Publish'),
            'unpublish' => GamesModule::t('Unpublish'),
        ]);
    }

    public function unpublish(array $data = [])
    {
        Post::objects()->filter(['pk' => $data])->update(['is_published' => false]);

        $this->redirect('admin.list', [
            'module' => $this->getModel()->getModuleName(),
            'adminClass' => $this->classNameShort()
        ]);
    }

    public function publish(array $data = [])
    {
        Post::objects()->filter(['pk' => $data])->update(['is_published' => true]);

        $this->redirect('admin.list', [
            'module' => $this->getModel()->getModuleName(),
            'adminClass' => $this->classNameShort()
        ]);
    }
}

