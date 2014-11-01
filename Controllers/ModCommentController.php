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
 * @date 11/09/14.09.2014 12:36
 */

namespace Modules\Games\Controllers;

use Mindy\Orm\Model;
use Modules\Comments\Controllers\BaseCommentController;
use Modules\Comments\Models\BaseComment;
use Modules\Games\Models\ModComment;
use Modules\Games\Models\Game;
use Modules\Games\Models\Mod;

class ModCommentController extends BaseCommentController
{
    public $toLink = 'mod_id';

    /**
     * @return \Modules\Comments\Models\BaseComment
     */
    public function getModel()
    {
        return new ModComment;
    }

    public function fetchModel($slug, $pk)
    {
        $game = Game::objects()->filter(['slug' => $slug])->get();
        if ($game === null) {
            $this->error(404);
        }
        $model = Mod::objects()->filter(['game' => $game, 'pk' => $pk])->get();
        if ($model === null) {
            $this->error(404);
        }
        return $model;
    }

    public function getTemplate($name = null)
    {
        return 'games/mod/_comments.html';
    }

    public function actionView($slug, $pk)
    {
        $this->internalActionList($this->fetchModel($slug, $pk));
    }

    public function actionSave($slug, $pk)
    {
        $this->internalActionSave($this->fetchModel($slug, $pk));
    }

    /**
     * @param Model $model
     * @param \Mindy\Orm\Manager|\Mindy\Orm\QuerySet $qs
     * @return \Mindy\Orm\Manager|\Mindy\Orm\QuerySet
     */
    public function processComments(Model $model, $qs)
    {
        return $qs->filter(['mod' => $model]);
    }

    /**
     * @param BaseComment $model
     * @return BaseComment
     */
    public function processComment(BaseComment $model)
    {
        return $model;
    }
}
