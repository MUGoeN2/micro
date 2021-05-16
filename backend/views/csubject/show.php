<?php
use \yii\helpers\Url;
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

       <?php if(isset($v['parent_id'])){ ?>
        </table>
             <table class="table table-bordered">
               <tr><th><?php echo $v['label_id'].'、'. $v['label_name']; ?> </th> <th>跳转</th><th class="change"><a class="btn btn-primary">修改</a></th></tr>
                <?php }else{?>
               <tr><td><?php echo  $v['label_id'].'、'.$v['label_name'];?></td> <td>跳转至<?php echo $v['foreign_id'] ?></td><td class="change"><a class="btn btn-primary">修改</a></td></tr>

           <?php    }  } ?>
             </table>
    </div>
</div>