<?php
use \yii\helpers\Url;


$this->title = '所有试题 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['admin']];
$this->params['breadcrumbs'][] = '所有试题';

?>


<div class="row">
    <div class="col-md-6">
        <div class="alert alert-info">试题</div>
        <table class="table table-bordered">
            <?php foreach($model as $v){?>

            <?php if(empty($v->parent_id)){ ?>
        </table>
        <table class="table table-bordered">
            <tr><th><?php echo $v->label_id.'、'. $v->label_name; ?> </th></tr>
            <?php }else{?>
                <tr><td><?php echo  $v->label_id.'、'.$v->label_name;?></td></tr>

            <?php    }  } ?>
        </table>
     <?php   echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
        ]);?>
    </div>
    <div class="col-md-6">

        <div class="alert alert-info">试题筛选</div>
        <h4>按标签分类</h4>
            <div class="btn-group" role="group" aria-label="...">
            <?php $LabelCate=\common\models\LabelCate::find()->all();
            foreach($LabelCate as $v){ ?>
            <a type="button" class="btn btn-default" ><?php echo $v->name?></a>
            <?php }?>
            </div>
        <h4>按试卷分类</h4>
        <div class="btn-group" role="group" aria-label="...">
            <?php $PaperCate=\common\models\CepingPaper::find()->all();
            foreach($PaperCate as $v){ ?>
                <a type="button" class="btn btn-default" ><?php echo $v->paper_name?></a>
            <?php }?>
        </div>
        </div>
</div>
