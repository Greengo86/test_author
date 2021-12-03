<?php
namespace frontend\controllers;

use frontend\actions\book\IndexAction;
use frontend\actions\book\ViewAction;
use frontend\models\rest\Book;
use frontend\models\rest\IndexBook;
use frontend\models\rest\ViewBook;

class BookController extends BaseApiController
{
	public $modelClass = Book::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => IndexAction::class,
            'modelClass' => IndexBook::class,
            'checkAccess' => [$this, 'checkAccess'],
        ];
        $actions['view'] = [
            'class' => ViewAction::class,
            'modelClass' => ViewBook::class,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        $actions['update']['scenario'] = 'update';
        $actions['create']['scenario'] = 'create';

        return $actions;
    }
}
