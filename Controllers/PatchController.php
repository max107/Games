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

use Mindy\Pagination\Pagination;
use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Game;
use Modules\Games\Models\Patch;

class PatchController extends CoreController
{
    public function actionIndex($slug)
    {
        $game = Game::objects()->filter(['slug' => $slug])->get();
        if ($game === null) {
            $this->error(404);
        }
        $qs = Patch::objects()->filter(['game' => $game]);
        $pager = new Pagination($qs);
        echo $this->render('games/patch/list.html', [
            'pager' => $pager,
            'models' => $pager->paginate(),
            'game' => $game
        ]);
    }

    public function actionView($pk)
    {
        $model = Patch::objects()->filter(['pk' => $pk])->get();
        if ($model === null) {
            $this->error(404);
        }

        echo $this->render("games/patch/view.html", [
            'model' => $model
        ]);
    }
}
