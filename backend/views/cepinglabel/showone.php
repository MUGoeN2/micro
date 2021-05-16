<?php
use \yii\helpers\Url;

$this->title = '查看新题';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .table tr th, .table tr td{
        width: 70%;;
    }
    .change{
        text-align: center;
    }
</style>
<div class="row">
    <h5 class="text-center">欢迎：<?php  echo Yii::$app->user->identity->username; ?>&#12288;&#12288;
        <!--        --><?php //if(Yii::app()->user->name!='Guest'){?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/out'); ?><!--">退出</a>-->
        <!--        --><?php //}else{?>
        <!--            <a href="--><?php // echo Yii::app()->createUrl('site/login'); ?><!--">登录</a>-->
        <!--        --><?php //}?>
    </h5>
</div>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <table class="table table-bordered">
       <?php foreach($model as $v){?>

       <?php if(empty($v->parent_id)){ ?>
        </table>
             <table class="table table-bordered">
               <tr><th><?php echo $v->label_id.'、'. $v->label_name; ?> </th> <th class="change">修改</th> <th class="change">删除</th></tr>
                <?php }else{?>
               <tr><td><?php echo  $v->label_id.'、'.$v->label_name;?></td> <td class="change"><a class="btn btn-primary">修改</a></td> <td class="change"><a class="btn btn-primary">删除</a></td></tr>

           <?php    }  } ?>
             </table>
    </div>
</div>