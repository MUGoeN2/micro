<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章';
$this->params['breadcrumbs'][] = $this->title;
if(!isset($_GET['sort'])) $_GET['sort']='-weight';
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cate',
//            'uid',
//            'username',
            'article_id',
            'kind',
            //'pic',
            // 'file',
            'title',
            // 'brief',
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{up}{copy}',//只需要展示删除和更新
                'headerOptions' => ['width' => '300'],
                'buttons' => [
                    'up' => function($url, $model, $key){
                        return Html::a('置顶',
                            ['up', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'data' => ['confirm' => '确认要置顶吗？',]
                            ]
                        );
                    },
                    'copy' => function($url, $model, $key){
                        $url=\Yii::$app->params['domain'].\yii\helpers\Url::to(['cs/news','article_id'=>$model->article_id]);
                        if($model->file)   $url=\Yii::$app->params['domain'].Yii::$app->request->baseUrl.$model->file;
                        return Html::button('链接地址',
                            [
                                'type' => 'button',
                                'class' => 'btn btn-default btn-xs copy-url',
                                'data-url'=>$url,
                            ]
                        );

                    },
                ],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-center">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">链接地址</h4>
            </div>
            <div class="modal-body text-center">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(function(){
        $('.copy-url').click(function(){
            var text=$(this).attr('data-url');
            $('.modal-body').html(text);
            $('#myModal').modal('show');
        });
    })
</script>