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
use Modules\Games\Models\Game;
use Modules\User\UserModule;

class GameController extends CoreController
{
    public function actionIndex()
    {
        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.index'));
        $this->addTitle(UserModule::t('Games'));
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
        ]);

        echo $this->render('games/game/index.html');
    }

    public function actionView($slug)
    {
        $model = Game::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($model);
        $this->addTitle((string)$model);
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => (string)$model, 'url' => $model->getAbsoluteUrl()],
        ]);

        $pager = new Pagination($model->posts);
        echo $this->render('games/game/view.html', [
            'model' => $model,
            'pager' => $pager,
            'posts' => $pager->paginate()
        ]);
    }
}
