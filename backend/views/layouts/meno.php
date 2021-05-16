

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
    <!--    <script src="--><?php //echo Yii::$app->request->baseUrl.'/test/jquery.uploadify.js' ?><!--"></script>-->
    <!--    <link href="--><?php //echo Yii::$app->request->baseUrl.'/test/uploadify.css' ?><!--" rel="stylesheet">-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #f6f6f6" >
<?php $this->beginBody() ?>
<div class="wrap" style="font-family: 微软雅黑;">
    <?php
    $image=Yii::$app->request->baseUrl.'/assets/images/test/logo.png';
    NavBar::begin(
        [
            'brandLabel' => 'GrowthMemo',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    $menuItems = [
        ['label' => '首页','url'=>['grouth/index']],
        ['label' => '企业测评','url'=>['csubject/test']],
        ['label' => '智库工具','url'=>['tools/index']],
        ['label' => '关于', 'url' => ['grouth/about']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['/site/login']];
        $menuItems[] = ['label' => '注册', 'url' => ['/site/signup']];
    } else {
        $menuItems[] = ['label' => '管理后台', 'url' => ['site/admin']];

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
<div class="container" style="min-height: 100%;margin-top:60px;">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <?= $content ?>

</div>
<div class="container" style="background-color: #f6f6f6;margin-top: 80px">
    <div class="row ">
        <div class="col-md-12 text-center">
            <ul class="list-inline">
                <li>GrowthMemo</li>
                <li>成功案例</li>
                <li>加入Memo</li>
                <li>关于Memo</li>
                <li>反馈建议：826961585@qq.com</li>
            </ul>
        </div>
        <div class="col-md-12 text-center">
            猎范（北京）科技有限公司
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
 t>