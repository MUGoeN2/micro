

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo Yii::$app->request->baseUrl.'/js/jquery.min.js' ?>"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="Shortcut Icon" href="<?php echo Yii::$app->request->baseUrl.'/favicon.ico'?>">
    <?php $this->head() ?>
</head>
<body style="background-color: #f6f6f6;font-family: 微软雅黑">
<?php $this->beginBody() ?>
<div class="container">
    <div class="row">


        <?php
        NavBar::begin(
            [
                'brandLabel' => '管理后台',
                'brandUrl' => ['admin/login'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]
        );
        $menuItems = [
            ['label' => '首页','url'=>['micro/index']],
//        ['label' => '企业测评','url'=>['csubject/test']],
//        ['label' => '智库工具','url'=>['tools/index']],
//        ['label' => '关于', 'url' => ['grouth/about']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '登录', 'url' => ['admin/login']];
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
</div>
<div class="container" style="min-height: 100%;margin-top:10%;">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <?= $content ?>

</div>
<hr>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>