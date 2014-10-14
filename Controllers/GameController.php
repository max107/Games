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
 * @date 05/10/14.10.2014 18:48
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\GamesModule;
use Modules\Games\Models\Game;

class GameController extends CoreController
{
    public function actionIndex()
    {
        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.index'));
        $this->addTitle(GamesModule::t('Games'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
        ]);

        echo $this->render('games/game/index.html');
    }

    public function actionView($slug)
    {
        $game = Game::objects()->filter(['slug' => $slug])->get();
        if ($game === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($game);
        $this->addTitle((string)$game);
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$game, 'url' => $game->getAbsoluteUrl()],
        ]);

        $pager = new Pagination($game->posts);
        echo $this->render('games/game/view.html', [
            'game' => $game,
            'pager' => $pager,
            'posts' => $pager->paginate()
        ]);
    }
}