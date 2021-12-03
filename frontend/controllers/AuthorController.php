<?php

namespace frontend\controllers;

use frontend\actions\author\StatisticAction;
use frontend\actions\author\ViewAction;
use frontend\actions\author\IndexAction;
use frontend\models\rest\Author;
use frontend\models\rest\AuthorStatistic;
use frontend\models\rest\IndexAuthor;
use frontend\models\rest\ViewAuthor;

class AuthorController extends BaseApiController
{
	public $modelClass = Author::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['statistic'] = [
            'class' => StatisticAction::class,
            'modelClass' => AuthorStatistic::class,
            'checkAccess' => [$this, 'checkAccess'],
        ];
        $actions['index'] = [
            'class' => IndexAction::class,
            'modelClass' => IndexAuthor::class,
            'checkAccess' => [$this, 'checkAccess'],
        ];
        $actions['view'] = [
            'class' => ViewAction::class,
            'modelClass' => ViewAuthor::class,
            'checkAccess' => [$this, 'checkAccess'],
        ];

        $actions['update']['scenario'] = 'update';
        $actions['create']['scenario'] = 'create';

        return $actions;
    }
}
