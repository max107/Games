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
 * @date 05/10/14.10.2014 19:44
 */

namespace Modules\Games\Admin;

use Modules\Admin\Components\ModelAdmin;
use Modules\Games\Forms\PublisherForm;
use Modules\Games\Models\Publisher;

class PublisherAdmin extends ModelAdmin
{
    public function getColumns()
    {
        return ['name'];
    }

    public function getCreateForm()
    {
        return PublisherForm::className();
    }

    /**
     * @return \Mindy\Orm\Model
     */
    public function getModel()
    {
        return new Publisher;
    }
}
