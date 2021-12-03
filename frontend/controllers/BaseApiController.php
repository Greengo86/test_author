<?php

namespace frontend\controllers;

use yii\rest\ActiveController;

class BaseApiController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
    ];

    public function checkAccess($action, $model=null, $params=[]) {
        return true;
    }

    /**
     * @return array
     */
    public function behaviors() {
        return [
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }
}
