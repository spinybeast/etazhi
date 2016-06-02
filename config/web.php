<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'gii' => ['class' => 'yii\gii\Module'],
        'admin' => ['class' => 'app\modules\admin\Module'],
    ],
    'components' => [
        'urlManager' => [
            'showScriptName'=>false,
            'enablePrettyUrl' => true,
            'rules' => [
                '' => 'site/index',
                'contact' => 'site/contact',
                'exclusives' => 'exclusives/index',
                'services' => 'services/index',
                'reviews' => 'reviews/index',
                'reviews/create' => 'reviews/create',
                'login' => 'admin/default/login',
                'admin' => 'admin/default/index',
                '<controller:(exclusives)>/<action:(house|flat|rooms)>' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<action:\w+>' => 'site/static',
            ]
        ],
        'request' => [
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'l0t8-TSg60zRtdlI00r0ScU2lY01aSYy',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'loginUrl' => ['admin/default/login'],
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
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
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin'], // Здесь нет роли "guest", т.к. эта роль виртуальная и не присутствует в модели UserExt
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
}

return $config;
