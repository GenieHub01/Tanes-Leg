<?php

$config = [
    'name' => getenv('APP_NAME'),
    'language' =>getenv('APP_LANG'),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => require(__DIR__ . '/db.php'),
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'blitline' => [
            'class' => 'common\components\BlitlineComponent',
            'defaultBucket' =>  getenv('S3_DEFAULTBUCKET'),
            'apiKey' => getenv('BLITLINE_APPLICATION_ID'),
            's3region' => getenv('S3_REGION'),
        ],
        'mailer' => [
            //'class' => 'yii\swiftmailer\Mailer',
//            'class' => \YarCode\Yii2\Mailgun\Mailer::class,
            'class' =>\common\components\Mailer::class,
            'apiEndpoint' =>  getenv('MAILGUN_ZONE') == 'eu' ? 'api.eu.mailgun.net' : 'api.mailgun.net' ,
//            'apiEndpoint' => getenv('MAILGUN_DOMAIN'),
            'domain' => getenv('MAILGUN_DOMAIN'),
            'apiKey' => getenv('MAILGUN_API_KEY'),
            'useFileTransport' => filter_var(getenv('MAILER_USE_FILE_TRANSPORT'), FILTER_VALIDATE_BOOLEAN),
            'viewPath' => '@common/mail',
            //   'textLayout' => 'my/layout',  // custome layout
            'htmlLayout' => 'layouts/html', // disable layout
            //        'apiKey' => getenv('SENDGRID_API_KEY'),
        ],
        's3' => [
            'class' => 'frostealth\yii2\aws\s3\Service',
            'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                'key' => getenv('S3_KEY'),
                'secret' => getenv('S3_SECRET'),

            ],
            'region' => getenv('S3_REGION'),
            'defaultBucket' => getenv('S3_DEFAULTBUCKET'),
            'defaultAcl' => 'public-read',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'thousandSeparator' => ',',
            'decimalSeparator' => ',',
            'currencyCode' => 'GBP',

        ],

    ],
    'modules'=>[
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module'
        ]
    ]
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1','192.168.0.1','5.44.168.166','172.*.*.*'  , '::1', getenv('YII_DEBUG_ALLOW_IP')],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1','192.168.0.1','5.44.168.166','172.*.*.*', '::1', getenv('YII_DEBUG_ALLOW_IP')],
    ];
}


return $config;