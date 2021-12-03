<?php

namespace frontend\actions\author;

use Yii;
use yii\data\ActiveDataProvider;

class StatisticAction extends \yii\rest\Action
{
    public function run()
    {
        if ($this->checkAccess) {
            call_user_func($this->checkAccess, $this->id);
        }

        return $this->prepareDataProvider();
    }

    protected function prepareDataProvider()
    {
        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $modelClass::find(),
            'sort' => ['defaultOrder' => [
                    'name' => SORT_ASC,
                    'surname' => SORT_ASC,
                ]
            ],
        ]);

    }
}