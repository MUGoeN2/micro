<?php
use \yii\helpers\Url;

$this->title = '试卷浏览 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = '试卷浏览';
?>
<div class="row">
    <h5 class="text-center">欢迎：<?php  echo Yii::$app->user->identity->username; ?>&#12288;&#12288;
        <!--        --><?php //if(Yii::app()->user->name!='Guest'){?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/out'); ?><!--">退出</a>-->
        <!--        --><?php //}else{?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/login'); ?><!--">登录</a>-->
        <!--        --><?php //}?>
    </h5>
</div>
<hr>
<div class="row">
    <?php foreach($model as $v){?>
    <div class="col-md-6 ">
        <div class="media">
            <div class="media-left">
                <a href="<?php echo Url::to(['csubject/showpaper','paperId'=> $v->paperId])?>">
                    <img class="media-object" src="<?php echo Yii::$app->request->baseUrl.'/img/grouth.jpg'?>" alt="..." width="50px">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading">试卷名：<?php echo $v->paper_name ?></h4>
                 <ul class="list-inline">
                     <li>试卷编号：<?php echo $v->paperId ?></li>
                     <li>创建时间：<?php echo date('Y-m-d H:i',$v->created_at) ?></li>
                     <li>更新时间：<?php echo date('Y-m-d H:i',$v->updated_at) ?></li>
                     <li> <a href="<?php echo Url::to(['csubject/test','paperId'=> $v->paperId])?>"> 去答题</a></li>
                 </ul>
            </div>
        </div>
    </div>
    <?php }?>
</div>