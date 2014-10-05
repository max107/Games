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

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Post;

class BlogController extends CoreController
{
    public function actionView($slug, $pk, $url)
    {
        $qs = Post::objects()->published()->filter([
            'game__slug' => $slug,
            'pk' => $pk,
            'url' => $url
        ])->get();

        $cache = Mindy::app()->cache;
        if (($model = $cache->get('games_blog_post_' . $url, null)) === null) {
            $model = $qs->get();
            if ($model === null) {
                $this->error(404);
            }
        }

        $this->setCanonical($model);

        $this->addTitle((string)$model->category);
        $this->addTitle((string)$model);

        $category = $model->category;
        $parents = $category->objects()->ancestors()->order(['lft'])->all();
        $parents[] = $category;
        $breadcrumbs = [];
        foreach ($parents as $parent) {
            $breadcrumbs[] = [
                'url' => $parent->getAbsoluteUrl(),
                'name' => (string)$parent,
            ];
        }
        $breadcrumbs[] = ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()];
        $this->setBreadcrumbs($breadcrumbs);

        echo $this->render('games/blog/view.html', [
            'model' => $model,
            'hasComments' => $model->hasField('comments')
        ]);
    }

    public function actionIndex($slug)
    {
        $qs = Post::objects()->published()->filter(['game__slug' => $slug])->order(['-published_at']);
        $pager = new Pagination($qs);
        echo $this->render('games/blog/index.html', [
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
