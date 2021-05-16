<?php
use \yii\helpers\Url;

$this->title = '试卷管理 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = '试卷管理';
?>

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
                <h4 class="media-heading text-center">试卷名：<?php echo $v->paper_name ?></h4>
                 <table class="table">
                     <tr><th>试卷编号</th><th>创建时间</th><th>更新时间</th><th>试卷权重</th></tr>
                     <tr>
                         <td><?php echo $v->paperId ?></td>
                         <td><?php echo date('Y-m-d H:i',$v->created_at) ?></td>
                         <td><?php echo date('Y-m-d H:i',$v->updated_at) ?></td>
                         <td><?php echo $v->weight ?></td>
                     </tr>
                     <tr><td>
                             <a href="<?php echo Url::to(['paperlabel/create','paper_name'=> $v->paper_name,'paper_id'=> $v->paperId])?>">添加试题</a>
                         </td>
                         <td>
                             <a href="<?php echo Url::to(['csubject/order','paper_name'=> $v->paper_name,'paper_id'=> $v->paperId])?>">试题排序</a>
                         </td>
                         <td>
                             <a href="<?php echo Url::to(['paperlabel/update_paper','paper_id'=> $v->paperId])?>">修改试卷</a>
                         </td>
                     </tr>
                 </table>
            </div>
        </div>
    </div>
    <?php }?>
</div>