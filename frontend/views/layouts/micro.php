

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;

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
<style>
    .navbar{
        border-radius: 0!important;
    }
    #w0{
        margin-bottom: 5px!important;
    }
</style>
<script>
    window.onload=function(){
        Lazy();
    };
    function Lazy(){
        $("img.lazy").lazyload({});
    }
</script>
<body style="font-family: 微软雅黑" >
<?php $this->beginBody() ?>
<div class="wrap" style="color: #fff">
    <?php
    $image=Yii::$app->request->baseUrl.'/img/logo.png';
    NavBar::begin(['brandLabel' => '怀瑜科技有限公司',  'brandUrl' => "#"]);
    $cates=\common\models\Cate::find()->where(['status'=>1])->orderBy('weight DESC')->asArray()->limit(3)->all();
    $n=0;
    $cate_arr=[];
    if(!empty($cates)){
        foreach($cates as $v) {
            $n++;
            $cate_arr[]=  ['label' => $v['name'],'url'=>['#cate-'.$n]];
        }
    }
    $menuItems =$cate_arr;
    echo \yii\bootstrap\Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</div>

<?= $content ?>


<div class="footer" style="margin:5px;">
    <div class=" text-center" style="font-size:12px;width: 100%;color: #9f9a9a">
        反馈建议 email： 57827289@qq.com
        <!--    57827289@qq.com-->
        <br>
        <span class="glyphicon glyphicon-copyright-mark"></span>尽致网络科技成都有限公司 技术支持&nbsp;
        京ICP备15056769号-1
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

