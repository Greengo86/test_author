<?php
namespace frontend\actions\author;

use Yii;
use yii\data\ActiveDataProvider;

class IndexAction extends \yii\rest\Action
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
            'sort' => ['defaultOrder' => ['updated_at' => SORT_ASC]],
        ]);

    }
}