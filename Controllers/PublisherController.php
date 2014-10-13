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
 * @date 07/10/14.10.2014 15:17
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Publisher;
use Modules\Games\GamesModule;

class PublisherController extends CoreController
{
    public function actionIndex()
    {
        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.publisher_list'));
        $this->addTitle(GamesModule::t('Publishers'));
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => GamesModule::t('Publishers'), 'url' => $urlManager->reverse('games.publisher_list')],
        ]);

        $qs = Publisher::objects();
        $pager = new Pagination($qs);
        echo $this->render('games/publisher/list.html', [
            'models' => $pager->paginate(),
            'pager' => $pager
        ]);
    }

    public function actionView($slug)
    {
        $model = Publisher::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($model);
        $this->addTitle(GamesModule::t('Publishers'));
        $this->addTitle($model);
        $this->setBreadcrumbs([
            ['name' => GamesModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => GamesModule::t('Publishers'), 'url' => $urlManager->reverse('games.publisher_list')],
            ['name' => (string) $model, 'url' => $model->getAbsoluteUrl()]
        ]);

        $pager = new Pagination($model->games);
        echo $this->render('games/publisher/view.html', [
            'model' => $model,
            'games' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
