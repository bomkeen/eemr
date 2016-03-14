<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language'=>'th_TH',
    'timeZone' => 'Asia/Bangkok',
    'modules' => [
        'user' => [
        'class' => 'dektrium\user\Module',
        'enableUnconfirmedLogin' => true,
        'confirmWithin' => 21600,
        'cost' => 12,
        'admins' => ['bomkeen']
    ],
        
    ],
    'components' => [
        'urlManager' => [
            'class' => 'yii\web\urlManager',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
     ],
     'urlManagerFrontend' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/eemr/frontend/web',
            'scriptUrl'=>'/eemr/frontend/web/index.php',
            'enablePrettyUrl' => false,
            'showScriptName' => true,
     ],
        'user' => [
            //'identityClass' => 'common\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
