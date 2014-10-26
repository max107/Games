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
 * @date 24/10/14.10.2014 23:24
 */

namespace Modules\Games\Controllers;

use Modules\Core\Controllers\CoreController;
use Modules\Games\GamesModule;

class ChatController extends CoreController
{
    public function actionIndex()
    {
        $this->addBreadcrumb(GamesModule::t('Chat'));
        echo $this->render("games/chat.html");
    }
}
