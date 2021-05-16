<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'language'=>'zh-CN',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
//    'modules' => [
//        'admin' => [
//            'class' => 'frontend\modules\admin\adminModule',
//        ],
//    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                // your rules go here
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
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
        'smser' => [
                  // 云片网
                  'class' => 'daixianceng\smser\YunpianSmser',
                  'apikey' => '38ea0e10acba5ffb9a1906c95ea8d892', // 请替换成您的apikey
                  'useFileTransport' => false,
              ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',  //每种邮箱的host配置不一样
                'username' => 'libo5782789@163.com',
                'password' => 'dzyimebcrvwxpdah',
                'port' => '25',
                'encryption' => 'tls',

            ],
//            'messageConfig'=>[
//                'charset'=>'UTF-8',
//                'from'=>['libo5782789@163.com'=>'admin']
//            ],
        ],

        'errorHandler' => [
            'errorAction' => 'micro/index',
        ],
    ],
    'params' => $params,
];
