<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
if(!isset($_GET['sort'])) $_GET['sort']='-weight';

?>
<div class="banner-index">


    <p>
        <?php
        echo Html::a('添加轮播图', ['create','cate'=> 1], ['class' => 'btn btn-success']);
        echo '<p class="well">轮播图片，展示在主页上方</p>';
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
//            'cate',
//            'pic',
//            'weight',
//            'url:url',
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{up}',//只需要展示删除和更新
                'headerOptions' => ['width' => '300'],
                'buttons' => [
                    'up' => function($url, $model, $key){
                        return Html::a('置顶',
                            ['up', 'id' => $key,'cate'=>$model->cate],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'data' => ['confirm' => '确认要置顶吗？',]
                            ]
                        );
                    },
                ],
            ],
            ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '400']
            ],
        ],
    ]); ?>

</div>
