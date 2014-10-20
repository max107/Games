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
use Modules\Games\Models\Game;
use Modules\Games\Models\Post;
use Modules\Games\GamesModule;

class PostController extends CoreController
{
    public function actionView($slug, $pk, $url)
    {
        $gameQs = Game::objects()->filter(['slug' => $slug]);
        $cache = Mindy::app()->cache;
        if (($game = $cache->get('games_game_' . $slug, null)) === null) {
            $game = $gameQs->get();
            if ($game === null) {
                $this->error(404);
            }
        }
        
        $qs = Post::objects()->published()->filter([
            'game' => $game,
            'pk' => $pk,
            'url' => $url
        ]);
        $cache = Mindy::app()->cache;
        if (($model = $cache->get('games_blog_post_' . $url, null)) === null) {
            $model = $qs->get();
            if ($model === null) {
                $this->error(404);
            }
        }

        $this->setCanonical($model);

        $this->addTitle((string)$game);
        $this->addTitle((string)$model);

        $urlManager = Mindy::app()->urlManager;
        $breadcrumbs = [
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
            ['name' => GamesModule::t('Blog'), 'url' => $urlManager->reverse('games.post_list', ['slug' => $game->slug])],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()]
        ];
        $this->setBreadcrumbs($breadcrumbs);

        echo $this->render('games/blog/view.html', [
            'game' => $game,
            'model' => $model,
            'hasComments' => $game->hasField('comments')
        ]);
    }

    public function actionIndex($slug)
    {
        $qs = Game::objects()->filter(['slug' => $slug]);
        $cache = Mindy::app()->cache;
        if (($game = $cache->get('games_game_' . $slug, null)) === null) {
            $game = $qs->get();
            if ($game === null) {
                $this->error(404);
            }
        }

        $urlManager = Mindy::app()->urlManager;

        $this->setCanonical($urlManager->reverse('games.post_list', ['slug' => $game->slug]));
        $this->addTitle((string)$game);
        $this->addTitle(GamesModule::t('Blog'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
            ['name' => GamesModule::t('Blog'), 'url' => $urlManager->reverse('games.post_list', ['slug' => $game->slug])],
        ]);

        $qs = Post::objects()->published()->filter(['game' => $game])->order(['-published_at']);
        $pager = new Pagination($qs);
        echo $this->render('games/blog/index.html', [
            'game' => $game,
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
