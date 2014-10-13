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
 * @date 11/10/14.10.2014 18:09
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Genre;
use Modules\Games\GamesModule;

class GenreController extends CoreController
{
    public function actionList()
    {
        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.genre_list'));
        $this->addTitle(GamesModule::t('Genres'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => GamesModule::t('Genres'), 'url' => $urlManager->reverse('games.genre_list')],
        ]);

        $qs = Genre::objects();
        $pager = new Pagination($qs);
        echo $this->render('games/genre/list.html', [
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }

    public function actionView($slug)
    {
        $model = Genre::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($model);
        $this->addTitle(GamesModule::t('Genres'));
        $this->addTitle($model);
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => GamesModule::t('Genres'), 'url' => $urlManager->reverse('games.genre_list')],
            ['name' => (string) $model, 'url' => $model->getAbsoluteUrl()]
        ]);

        $pager = new Pagination($model->games);
        echo $this->render('games/genre/view.html', [
            'model' => $model,
            'games' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
