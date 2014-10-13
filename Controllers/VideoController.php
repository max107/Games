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
 * @date 13/10/14.10.2014 16:22
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Game;
use Modules\Games\Models\Video;
use Modules\User\UserModule;

class VideoController extends CoreController
{
    public function actionList($slug)
    {
        $qs = Game::objects()->filter(['slug' => $slug]);
        $cache = Mindy::app()->cache;
        if (($model = $cache->get('games_game_' . $slug, null)) === null) {
            $model = $qs->get();
            if ($model === null) {
                $this->error(404);
            }
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.video_list', ['slug' => $model->slug]));
        $this->addTitle((string)$model);
        $this->addTitle(UserModule::t('Video'));
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()],
            ['name' => UserModule::t('Video'), 'url' => $urlManager->reverse('games.video_list', ['slug' => $model->slug])],
        ]);

        $pager = new Pagination($model->videos);
        echo $this->render('games/video/list.html', [
            'game' => $model,
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }

    public function actionView($slug, $pk)
    {
        $qs = Game::objects()->filter(['slug' => $slug]);
        $cache = Mindy::app()->cache;
        if (($game = $cache->get('games_game_' . $slug, null)) === null) {
            $game = $qs->get();
            if ($game === null) {
                $this->error(404);
            }
        }

        $model = Video::objects()->filter(['game' => $game, 'pk' => $pk])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($model);
        $this->addTitle((string)$game);
        $this->addTitle(UserModule::t('Video'));
        $this->addTitle((string)$model);
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
            ['name' => UserModule::t('Video'), 'url' => $urlManager->reverse('games.video_list', ['slug' => $game->slug])],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()]
        ]);

        echo $this->render('games/video/view.html', [
            'game' => $game,
            'model' => $model
        ]);
    }
}
