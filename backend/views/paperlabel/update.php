<?php

use yii\helpers\Html;
use \yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\PaperLabel */
$this->params['breadcrumbs'][] = ['label' => 'Paper Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="paper-label-update">
        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form =ActiveForm::begin(); ?>
        <div class="row">
            <?php foreach($labelModels as $v){?>
                <div class="col-md-4">
                    <label class="checkbox-inline">
                        <input type="checkbox"
                               id="<?php echo $v->label_id?>"
                               name="Paper[<?php echo $v->label_id?>]"
                               value="<?php echo$v->label_name?>"
                            <?php if(in_array($v->label_id,$paper_check)) echo "checked='true'"?>
                            >
                        <?php echo$v->label_name?>:
                    </label>
                    <br>
                </div>
            <?php }?>
        </div>

        <div class="form-group">
            <?= Html::submitButton( '提交', ['class' =>  'btn btn-success','name'=>'sub']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
