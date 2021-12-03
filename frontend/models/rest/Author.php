<?php
namespace frontend\models\rest;

use \common\models\Author as BaseAuthor;

class Author extends BaseAuthor
{
	public function fields(){
        return parent::fields();
	}

    public static function collectionName()
    {
        return BaseAuthor::tableName();
    }
}
