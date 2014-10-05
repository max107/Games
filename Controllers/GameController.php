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

use Modules\Core\Controllers\CoreController;
use Modules\Games\Models\Game;

class GameController extends CoreController
{
    public function actionIndex()
    {
        echo $this->render('games/index.html');
    }

    public function actionView($slug)
    {
        $model = Game::objects()->filter(['slug' => $slug])->get();
        if ($model === null) {
            $this->error(404);
        }
        echo $this->render('games/view.html', [
            'model' => $model
        ]);
    }
}
