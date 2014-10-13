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
 * @date 13/10/14.10.2014 16:36
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Game;
use Modules\Games\GamesModule;

class ScreenshotController extends CoreController
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
        $this->setCanonical($urlManager->reverse('games.screenshot_list', ['slug' => $model->slug]));
        $this->addTitle((string)$model);
        $this->addTitle(GamesModule::t('Video'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()],
            ['name' => GamesModule::t('Screenshots'), 'url' => $urlManager->reverse('games.screenshot_list', ['slug' => $model->slug])],
        ]);

        $pager = new Pagination($model->screenshots);
        echo $this->render('games/screenshot/list.html', [
            'game' => $model,
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
