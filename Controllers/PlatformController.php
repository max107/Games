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
 * @date 13/10/14.10.2014 13:46
 */

namespace Modules\Games\Controllers;

use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Game;
use Modules\Games\Models\Platform;

class PlatformController extends CoreController
{
    public function actionIndex()
    {
        $model = Platform::objects()->all();
        if ($model === null) {
            $this->error(404);
        }
        $qs = Game::objects()->filter(['platform' => $model]);
        $pager = new Pagination($qs);
        echo $this->render('games/platform/list.html', [
            'pager' => $pager,
            'games' => $pager->paginate(),
            'model' => $model
        ]);
    }

    public function actionView($slug)
    {
        $model = Platform::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }
        echo $this->render("games/platform/view.html", [
            'model' => $model
        ]);
    }
}
