<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PaperLabel */

//$this->title = $model->paper_id;
$this->params['breadcrumbs'][] = ['label' => 'Paper Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<?php //echo Html::a('Delete', ['delete', 'paper_id' => $model->paper_id, 'label_id' => $model->label_id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>


<?php //echo DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'paper_id',
//            'label_id',
//            'weight',
//            'status',
//            'created_at',
//            'updated_at',
//            'res1',
//            'res2',
//            'res3',
//        ],
//    ]) ?>

<table class="table table-bordered ">
    <?php  //p($model)
    foreach($model as $v) { ?>
        <tr>
            <td><?php echo $v->label_id?></td>
            <td><?php echo $v->relationLabel->label_name?></td>
            <td><a href="<?php echo Url::to(['csubject/update','id'=> $v->label_id])?>">设置选项/跳转</a></td>
        </tr>
    <?php } ?>
</table>
