<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php'
//    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
    ],
    'components' => [
        'db' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://host.docker.internal:27017/test_books',
        ],
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://host.docker.internal:27017/test_books',
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'QEqchQELmC-Yo_MvKGw_6dbPGq1i-IVM',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'front_s',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                //Для POST - create author и book сущности создаются автоматически и отдаются все необходимые поля
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'author',
                    'extraPatterns' => [
                        'GET statistic' => 'statistic',
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'book',
                ]
            ],
        ]
    ],
    'params' => $params,
];
