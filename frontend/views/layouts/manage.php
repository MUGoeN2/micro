

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
<html lang="<?= \Yii::$app->language ?>">
<head>
    <meta charset="<?= \Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo \Yii::$app->request->baseUrl.'/js/jquery.min.js' ?>"></script>
    <link href="<?php echo \Yii::$app->request->baseUrl.'/mine/font/iconfont.css' ?>" rel="stylesheet">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #f6f6f6">
<?php $this->beginBody() ?>
<div class="wrap" style="font-family: 微软雅黑;">
    <?php
    $image=\Yii::$app->request->baseUrl.'/assets/images/test/logo.png';
    NavBar::begin(
        [
            'brandLabel' => '管理后台',
            'brandUrl' => ['admin/index'],
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    //    $menuItems = [
    //        ['label' => '首页','url'=>['#']],
    //        ['label' => '案例','url'=>['#']],
    //        ['label' => '教程','url'=>['#']],
    //        ['label' => '关于', 'url' => ['#']],
    //    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => '退出 (' . Yii::$app->user->identity->username . ')',
            'url' => ['admin/logout'],
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
    <!--    --><?php //echo  Breadcrumbs::widget([
    //        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    //    ]) ?>
    <?= Alert::widget() ?>

    <div class="row" style="min-height: 100%;margin-top:15px;font-family:'微软雅黑'">
        <div class="col-md-2"  style="background-color: #fff;border-radius: 10px;padding: 20px 10px;min-height:400px;">
            <?php   echo \kartik\sidenav\SideNav::widget([
                'items' => [
                    [
                        'url' => ['#'],
                        'label' => '轮播图',
                        'icon' => 'glyphicon glyphicon-picture',
                        'items'=>[
                            ['url' => [ 'banner/index','cate'=>1], 'label' => '轮播图'],
//                            ['url' => [ 'banner/index' ,'cate'=>2], 'label' => '项目版块'],
                        ]
                    ],
                    [
                        'url' => [ 'item/index'],
                        'label' => '产品管理',
                        'icon' => 'glyphicon glyphicon-th-list',
//                        'items'=>[
//                            ['url' => [ 'banner/index','cate'=>1], 'label' => '首页轮播'],
//                            ['url' => [ 'banner/index' ,'cate'=>2], 'label' => '项目版块'],
//                        ]
                    ],
//                    [
//                        'url' => ['#'],
//                        'label' => '文章管理',
//                        'icon' => 'glyphicon glyphicon-th',
//                        'items' => [
//                            ['url' => [ 'article/index','type'=>''], 'label' => '所有文章'],
//                            ['url' => [ '#'], 'label' => '资讯文章',
//                                'items'=>[
//                                    ['url' => [ 'article/create','kind'=>2], 'label' => '发布资讯'],
//                                    ['url' => [ 'article/index','kind'=>2], 'label' => '资讯列表'],
//                                ]
//                            ],
//                            [
//                                'url' => [ '#'],
//                                'label' => '栏目介绍',
//                                'items'=>[
//                                    ['url' => [ 'article/create','kind'=>1], 'label' => '发布介绍'],
//                                    ['url' => [ 'article/index' ,'kind'=>1], 'label' => '介绍列表'],
//                                ]
//                            ],
//
//                        ],
//                    ],
                    [
                        'url' => ['#'],
                        'label' => '栏目分类',
                        'icon' => 'glyphicon glyphicon-th-list',
                        'items' => [
                            [
                                'url' => ['cate/index'],
                                'label' => '栏目列表',
                            ],
                            ['url' => [ 'cate/create','level'=>1], 'label' => '新建一级栏目'],
                            ['url' => [ 'cate/create','level'=>2], 'label' => '新建二级栏目'],
                        ],
                    ],
                ],
            ]);?>
        </div>
        <div class="col-md-10">
            <div style="background-color: #fff;padding:20px;min-height: 500px">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<!--<div class="container" style="background-color: #f6f6f6;margin-top: 80px">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12 text-center">-->
<!--            <ul class="list-inline">-->
<!--                <li>微运营CRM</li>-->
<!--                <li>成功案例</li>-->
<!--                <li>加入我们</li>-->
<!--                <li>关于M我们</li>-->
<!--                <li>反馈建议：57827289@qq.com</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <div class="col-md-12 text-center">-->
<!--            尽致科技成都有限公司-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <footer class="footer">-->
<!--        <div class="container">-->
<!--            <p class="pull-left">&copy;尽致科技成都有限公司 --><?//= date('Y') ?><!--</p>-->
<!--        </div>-->
<!--    </footer>-->
<!--</div>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

