<?php
use \yii\helpers\Url;

$this->title = '管理中心 ';
$this->params['breadcrumbs'][] = '管理中心';
?>

<div class="row">
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>题库</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['cepinglabel/index'])?>">标签管理</a></li>
                <li> <a href="<?php echo Url::to(['cepinglabel/add'])?>">新题录入</a></li>
                <li><a href="<?php echo Url::to(['cepinglabel/showall'])?>">题库</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>手动组卷</h4>
            <ul class="list-inline">

                <li><a href="<?php echo Url::to(['paperlabel/add'])?>">新建试卷</a></li>
                <li><a href="<?php echo Url::to(['cepinglabel/pal'])?>">试卷管理</a></li>
                <li><a href="<?php echo Url::to(['cepinglabel/paper'])?>">试卷浏览</a></li>
            </ul>
        </div>
    </div>


    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>报告管理</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['creport/list'])?>">报告列表</a></li>
                <li><a href="<?php echo Url::to(['creport/create'])?>">报告设置</a></li>
                <!--                <li><a href="--><?php //echo Url::to(['cepinglabel/pal'])?><!--">试卷管理</a></li>-->
                <!--                <li><a href="--><?php //echo Url::to(['cepinglabel/paper'])?><!--">试卷浏览</a></li>-->
            </ul>
        </div>
    </div>

    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>文章管理</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['article/index'])?>">文章列表</a></li>
                <li><a href="<?php echo Url::to(['articlecate/index'])?>">分类管理</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>平台</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['intro/index'])?>">平台管理</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>提问处理</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['ask/chat'])?>">提问处理</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>系统设置</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to(['site/control'])?>">管理员注册</a></li>
                <li><a href="<?php echo Url::to(['pay/price'])?>">报告定价</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>M卡</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to([ 'cards/index'])?>">M卡管理</a></li>
                <li><a href="<?php echo Url::to([ 'cards/del'])?>">M卡清空</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="alert alert-info">
            <h4>邀请码</h4>
            <ul class="list-inline">
                <li><a href="<?php echo Url::to([ 'apply/control'])?>">开放注册</a></li>
                <li><a href="<?php echo Url::to([ 'apply/index'])?>">所有申请</a></li>
                <li><a href="<?php echo Url::to([ 'apply/sended'])?>">已通过</a></li>
                <li><a href="<?php echo Url::to([ 'apply/ready'])?>">未通过</a></li>
            </ul>
        </div>
    </div>

</div>