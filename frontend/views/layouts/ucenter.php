

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo Yii::$app->request->baseUrl.'/js/jquery.min.js' ?>"></script>
    <!--    <script src="--><?php //echo Yii::$app->request->baseUrl.'/test/jquery.uploadify.js' ?><!--"></script>-->
    <!--    <link href="--><?php //echo Yii::$app->request->baseUrl.'/test/uploadify.css' ?><!--" rel="stylesheet">-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="Shortcut Icon" href="<?php echo Yii::$app->request->baseUrl.'/favicon.ico'?>">
    <?php $this->head() ?>
</head>
<style>
    .navbar-brand{
        padding: 5px 8px;
    }
</style>
<body style="background-color: #f6f6f6;font-family: 微软雅黑">
<?php $this->beginBody() ?>
<div class="wrap" style="font-family: 微软雅黑;">
    <?php
    $image=Yii::$app->request->baseUrl.'/img/logo.png';
    NavBar::begin(
        [
            'brandLabel' => "<img src='$image'>",
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    $menuItems = [
        ['label' => '首页','url'=>['grouth/index']],
//        ['label' => '智库工具','url'=>['tools/index']],
//        ['label' => '企业测评','url'=>['csubject/test']],
        ['label' => '关于', 'url' => ['grouth/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = ['label' => '个人中心', 'url' => ['usercenter/index']];
        $menuItems[] = [
            'label' => '退出 (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>
<div class="container" style="min-height: 100%;margin-top:60px;font-family:'微软雅黑'">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <div class="row">
        <div class="col-md-2"  style="background-color: #fff;border-radius: 10px;padding: 30px 10px;">
            <?php   echo \kartik\sidenav\SideNav::widget([
                'items' => [
                    [
                        'url' => ['#'],
                        'label' => '用户中心',
                        'icon' => 'home'
                    ],
                    [
                        'url' => ['usercenter/index'],
                        'label' => '我的账号',
                        'icon' => 'user'
                    ],
                    [
                        'url' => ['usercenter/test_result'],
                        'label' => '我的测评',
                        'icon' => 'list-alt'
                    ],
                    [
                        'url' => ['usercenter/chat'],
                        'label' => '我的提问',
                        'icon' => 'question-sign'
                    ],
                    [
                        'url' => ['site/reset'],
                        'label' => '修改密码',
                        'icon' => 'wrench'
                    ],
                ],
            ]);?>
        </div>
        <div class="col-md-10" >
            <?= $content ?>
         </div>
        </div>
    </div>




<footer class="footer" style="background-color: #f6f6f6;color:#8a8a8a;font-size: 12px ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <ul class="list-inline">
                    <li>GrowthMemo</li>
                    <li><a href="<?php echo \yii\helpers\Url::to(['grouth/about'])?>">关于Memo</a></li>
                    <li>反馈建议：826961585@qq.com</li>
                </ul>
            </div>
            <div class="col-md-12 text-center">
                <span class="glyphicon glyphicon-copyright-mark"></span>猎范（北京）科技有限公司&nbsp;
                京ICP备15056769号-1
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

