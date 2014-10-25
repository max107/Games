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

class ChatController extends CoreController
{
    public function actionIndex()
    {
        echo $this->render("games/chat.html");
    }
}
