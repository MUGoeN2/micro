<?php
use \yii\helpers\Url;


$this->title = '报告列表 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = '报告列表';
?>

<div class="row">
    <?php foreach($model as $v){?>
    <div class="col-md-6">
        <div class="media" style="background-color: #fff;padding: 10px;border: 1px solid #f6f6f6">
            <div class="media-left">
                <a href="<?php echo Url::to(['creport/update','id'=> $v->id])?>">
                    <img class="media-object" src="<?php echo Yii::$app->request->baseUrl.'/img/grouth.jpg'?>" alt="..." width="50px">
                </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><strong><?php echo $v->name ?></strong></h4>
                 <ul >
                     <li>报告ID：<?php echo $v->id ?></li>
                     <li>试卷编号：<?php echo $v->paperId ?></li>
                     <li>创建时间：<?php echo date('Y-m-d H:i',$v->created_at) ?></li>
                     <li>更新时间：<?php echo date('Y-m-d H:i',$v->updated_at) ?></li>
                 </ul>
            </div>
        </div>

    </div>
    <?php }?>
</div>