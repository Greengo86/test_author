<?php
namespace frontend\actions\author;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

class ViewAction extends \yii\rest\Action
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
        $requestParams = \Yii::$app->getRequest()->getQueryParams();
        if (empty($requestParams)) {
            throw new BadRequestHttpException("Invalid request");
        }

        /* @var $modelClass \yii\db\BaseActiveRecord */
        $modelClass = $this->modelClass;

        return Yii::createObject([
            'class' => ActiveDataProvider::className(),
            'query' => $modelClass::find()->where(['id' => $requestParams['id']]),
            'sort' => [
                'params' => $requestParams,
            ],
        ]);
    }
}