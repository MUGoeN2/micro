<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');
//require(__DIR__ . '/../../vendor/duanxin/SDK/CCPRestSDK.php');//加载过后验证码输出不正常

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);
include_once "function.php";

ini_set('date.timezone','Asia/Shanghai');
include_once "lib/WxPay.Api.php";
include_once "lib/WxPay.Config.php";
include_once "lib/WxPay.Data.php";
include_once "lib/WxPay.Exception.php";
include_once "lib/WxPay.Notify.php";
include_once "lib/WxPay.NativePay.php";
include_once "lib/WxPay.JsApiPay.php";
include_once "lib/WxPay.MicroPay.php";

$application = new yii\web\Application($config);
$application->run();
