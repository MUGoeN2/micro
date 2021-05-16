<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '栏目分类';
$this->params['breadcrumbs'][] = $this->title;
if(!isset($_GET['sort'])) $_GET['sort']='-weight';
?>
<div class="cate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建一级栏目', ['create','level'=>1], ['class' => 'btn btn-success']) ?>
        <?= Html::a('创建二级栏目', ['create','level'=>2], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'level',
            'name',
            'parent_id',
//            'pic',
            // 'custom:ntext',
            // 'weight',
            // 'status',
            // 'created_at',
            // 'updated_at',

            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => ' {update} {delete} {view}{up}',//只需要展示删除和更新
                'headerOptions' => ['width' => '300'],
                'buttons' => [
                    'delete' => function($url, $model, $key){
                        if($model->parent_id !=0) return Html::a('<span class="glyphicon glyphicon-trash"></span> 删除',
                            ['delete', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs del-btn',
                                'data' => ['confirm' => '你确定要删除吗？',]
                            ]
                        );
                    },
                    'update' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span> 修改',
                            ['update', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                            ]);
                    },
                    'view' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>查看',
                            ['view', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                            ]);
                    },
                    'up' => function($url, $model, $key){
                        if($model->parent_id !=0)  return Html::a('置顶',
                            ['up', 'id' => $key],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'data' => ['confirm' => '确认要置顶吗？',]
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>

</div>
