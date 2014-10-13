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
 * @date 07/10/14.10.2014 15:35
 */

namespace Modules\Games\Controllers;

use Mindy\Base\Mindy;
use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Developer;
use Modules\Games\Models\Game;
use Modules\User\UserModule;

class DeveloperController extends CoreController
{
    public function actionIndex()
    {
        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($urlManager->reverse('games.developer_list'));
        $this->addTitle(UserModule::t('Developers'));
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => UserModule::t('Developers'), 'url' => $urlManager->reverse('games.developer_list')],
        ]);

        $qs = Developer::objects();
        $pager = new Pagination($qs);
        echo $this->render('games/developer/list.html', [
            'pager' => $pager,
            'models' => $pager->paginate()
        ]);
    }

    public function actionView($slug)
    {
        $model = Developer::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }

        $urlManager = Mindy::app()->urlManager;
        $this->setCanonical($model);
        $this->addTitle(UserModule::t('Developers'));
        $this->addTitle($model);
        $this->setBreadcrumbs([
            ['name' => UserModule::t('Games'), 'url' => $urlManager->reverse('games.index')],
            ['name' => UserModule::t('Developers'), 'url' => $urlManager->reverse('games.developer_list')],
            ['name' => (string) $model, 'url' => $model->getAbsoluteUrl()]
        ]);

        $pager = new Pagination($model->games);
        echo $this->render('games/developer/view.html', [
            'model' => $model,
            'games' => $pager->paginate(),
            'pager' => $pager
        ]);
    }
}
