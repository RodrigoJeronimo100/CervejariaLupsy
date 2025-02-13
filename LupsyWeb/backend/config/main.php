<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\ModuleAPI',
        ],
    ],
    'components' => [
        // 'response' => [
        //     'formatters' => [
        //         \yii\web\Response::FORMAT_JSON => [
        //             'class' => 'yii\web\JsonResponseFormatter',
        //         ],
        //     ],
        //     'format' => yii\web\Response::FORMAT_HTML, // Formato padrão
        // ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
            'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views/layouts'
             ],
         ],
    ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'api/cerveja', 'pluralize' => false, 'extraPatterns' => [
                    'POST {id}/favoritar' => 'favoritar',
                    'POST {id}/votar' => 'votar',
                    'GET categorias' => 'categorias',
                    'GET fornecedores' => 'fornecedores',
                    'GET {id}/nota' => 'nota',
                    'GET {id}/is-favorito' => 'is-favorito',
                ]],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/utilizador'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/user'], 'pluralize'=>false, 'extraPatterns' => [
                    'POST login' => 'login',
                ]],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/categoria'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/fornecedor'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/fatura'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/item-fatura'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/nota'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/comentario'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/favorita'], 'pluralize'=>false],
                ['class' => 'yii\rest\UrlRule', 'controller' =>  ['api/historico'], 'pluralize'=>false],
            ],
        ],
    ],
    'params' => $params,
];
