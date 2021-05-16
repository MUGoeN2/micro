<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = '新闻发布';
$this->params['breadcrumbs'][] = ['label' => '新闻', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->cate=1;
$model->uid=\Yii::$app->user->isGuest ? 'user' : \Yii::$app->user->id;
$model->username=\Yii::$app->user->isGuest ? 'username' : \Yii::$app->user->identity->username;
$model->article_id=date('YmdHis',time());
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
