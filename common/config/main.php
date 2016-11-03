<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
         'view' => [
            'theme' => [
                'basePath' => '@app/themes/interior',
                'baseUrl' => '@web/themes/interior',
                'pathMap' => [
                    '@app/views' => '@app/themes/interior',
                ],
            ],
        ],
    ],
];
