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
 * @date 07/10/14.10.2014 17:45
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\GamesModule;
use Modules\Games\Models\Game;
use Modules\Games\Models\Patch;

class PatchController extends CoreController
{
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
        $this->setCanonical($urlManager->reverse('games.patch_list', ['slug' => $game->slug]));
        $this->addTitle($game);
        $this->addTitle(GamesModule::t('Patches'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
            ['name' => GamesModule::t('Patches'), 'url' => $urlManager->reverse('games.patch_list', ['slug' => $game->slug])],
        ]);

        $qs = Patch::objects()->filter(['game' => $game]);
        $pager = new Pagination($qs);
        echo $this->render('games/patch/list.html', [
            'pager' => $pager,
            'models' => $pager->paginate(),
            'game' => $game
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

        $model = Patch::objects()->filter(['game' => $game, 'pk' => $pk])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.patch_list', ['slug' => $game->slug]));
        $this->addTitle($game);
        $this->addTitle(GamesModule::t('Patches'));
        $this->addTitle($model);
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
            ['name' => GamesModule::t('Patches'), 'url' => $urlManager->reverse('games.patch_list', ['slug' => $game->slug])],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()]
        ]);

        echo $this->render("games/patch/view.html", [
            'model' => $model
        ]);
    }
}
