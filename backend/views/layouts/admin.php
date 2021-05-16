

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
    <?php $this->head() ?>
</head>
<body style="background-color: #f6f6f6">
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
<div class="container" style="min-height: 100%;margin-top:60px;font-family:'微软雅黑'">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <div class="row">
        <div class="col-md-2"  style="background-color: #fff;border-radius: 10px;padding: 20px 10px;min-height:400px;">
         <?php   echo \kartik\sidenav\SideNav::widget([
                'items' => [
                    [
                         'url' => ['site/admin'],
                         'label' => 'Home',
                         'icon' => 'home'
                     ],
                     [
                         'url' => [ '#'],
                         'label' => '试题管理',
                         'icon' => 'info-sign',
                         'items' => [
                             ['url' => ['cepinglabel/index'], 'label' => '标签管理'],
                             ['url' => ['cepinglabel/add'], 'label' => '新题录入'],
                             ['url' => ['cepinglabel/showall'], 'label' => '题库'],

                       ],
                   ],
                    [
                        'url' => [ '#'],
                        'label' => '手动组卷',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['paperlabel/add'], 'label' => '新建试卷'],
                            ['url' => ['cepinglabel/paper'], 'label' => '试卷浏览'],
                            ['url' => ['cepinglabel/pal'], 'label' => '试卷管理'],
                        ],
                    ],
                    [
                        'url' => [ '#'],
                        'label' => '报告管理',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['creport/create'], 'label' => '添加报告'],
                            ['url' => ['creport/list'], 'label' => '报告列表'],
                        ],
                    ],
                    [
                        'url' => [ '#'],
                        'label' => '文章管理',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['article/index'], 'label' => '文章列表'],
                            ['url' => ['articlecate/index'], 'label' => '分类管理'],
                        ],
                    ],
                    [
                        'url' => [ 'intro/index'],
                        'label' => '平台名片管理',
                        'icon' => 'info-sign',
                    ],
                    [
                        'url' => [ '#'],
                        'label' => '提问处理',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['ask/chat'], 'label' => '提问处理'],
                        ],
                    ],
                    [
                        'url' => [ 'cards/index'],
                        'label' => 'M卡',
                        'icon' => 'info-sign',
                    ],
                    [
                        'url' => [ '#'],
                        'label' => '邀请处理',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['apply/index'], 'label' => '全部邀请'],
                            ['url' => ['apply/sended'], 'label' => '已发送'],
                            ['url' => ['apply/ready'], 'label' => '未发送'],
                        ],
                    ],
                    [
                        'url' => [ '#'],
                        'label' => '系统设置',
                        'icon' => 'info-sign',
                        'items' => [
                            ['url' => ['site/control'], 'label' => '管理员注册'],
                            ['url' => ['pay/price'], 'label' => '报告定价'],
                        ],
                    ],
                ],
             ]);?>
        </div>
        <div class="col-md-10" style="background-color: #fff;padding-top:20px;min-height: 500px">
            <?= $content ?>
         </div>
        </div>
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

<script>
    //    $(".navbar-header").ready(function(){
    //        $(this).find('.navbar-brand').html("<img src='<?php //echo $image;?>//' width='150px' height='50px'  class='img-rounded'>");
    //    });
</script>