<?php

namespace frontend\models\rest;

use common\models\Book as BaseBook;
use Yii;

class Book extends \common\models\Book
{
    public function fields()
    {
        return parent::fields();
    }

    public static function collectionName()
    {
        return BaseBook::tableName();
    }
}
