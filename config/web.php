<?php

// Cargar las variables de entorno
$env = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$loaded = $env->load();

// Incluir las configuraciones de parámetros y base de datos
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

// Configuración principal de la aplicación Yii2
$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // Clave secreta necesaria para la validación de cookies
            'cookieValidationKey' => '-pC9xeCp-2tlhY0fU3_rKoVeS5lM7tjE',
        ],
        'cache' => [
            'class' => 'yii\caching\DummyCache',
        ],
        'user' => [
            'identityClass' => 'app\models\AuthToken',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // Enviar todos los correos a un archivo por defecto.
            'useFileTransport' => true,
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
        'mongodb' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'defaultRoute' => 'site/index',
                '' => 'site/index',
                [
                    'pattern' => '<controller:\w+>/<action:\w+>',
                    'route' => '<controller>/<action>',
                ],
                [
                    'pattern' => '<module:\w+>/<controller:\w+>/<action:\w+>',
                    'route' => '<module>/<controller>/<action>',
                ]
            ],
        ],
        'jwt' => [
            'class' => \firebase\jwt\JWT::class,
            'key' => $_ENV['SECRET_JWT'], // La clave secreta para firmar y verificar el token
        ],
    ],
    'params' => $params,
];

// Ajustes de configuración para el entorno de desarrollo
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

// Devolver la configuración final
return $config;
