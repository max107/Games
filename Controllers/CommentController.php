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

use Mindy\Base\Mindy;
use Mindy\Orm\Model;
use Modules\Comments\Controllers\BaseCommentController;
use Modules\Comments\Models\BaseComment;
use Modules\Games\Models\Comment;
use Modules\Games\Models\Post;

class CommentController extends BaseCommentController
{
    public $toLink = 'post_id';

    /**
     * @return \Modules\Comments\Models\BaseComment
     */
    public function getModel()
    {
        return new Comment;
    }

    public function fetchModel($url)
    {
        $qs = Post::objects()->published()->filter(['url' => '/' . $url]);
        $model = Mindy::app()->cache->get('games_post_' . $url . '_comments', $qs->get());
        if($model === null) {
            $this->error(404);
        }
        return $model;
    }

    public function getTemplate($name)
    {
        return 'games/_comments.html';
    }

    public function actionView($url)
    {
        $this->internalActionList($this->fetchModel($url));
    }

    public function actionSave($url)
    {
        $this->internalActionSave($this->fetchModel($url));
    }

    /**
     * @param Model $model
     * @param \Mindy\Orm\Manager|\Mindy\Orm\QuerySet $qs
     * @return \Mindy\Orm\Manager|\Mindy\Orm\QuerySet
     */
    public function processComments(Model $model, $qs)
    {
        return $qs->filter(['post' => $model]);
    }

    /**
     * @param Comment $model
     * @return Comment
     */
    public function processComment(BaseComment $model)
    {
        return $model;
    }
}
