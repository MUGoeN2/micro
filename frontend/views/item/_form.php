<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(function(){
        $('#pic-main-plus').click(function(){
            $('#pic-main').click();
        });

        $('#pic-main').on('fileimageloaded', function(event) {
            $(this).fileinput('upload');
        });
        $('#pic-main').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response,
                reader = data.reader;
            $('#item-pic').val(response);
            var src_url="<?php echo Yii::$app->request->baseUrl;?>"+response;
            var html="<div class='row'>" +
                "<div class='col-md-12'>" +
                "<img src='"+src_url+"' style='max-width:100%'>" +
                "<span class='glyphicon glyphicon-remove-sign remove remove-main'></span>" +
                "</hr></div>" +
                "</div>";
            $('.pic-main-box').append(html);
            $('#pic-main-plus').hide();
        });
        $(document).on('click','.remove-main',function(){
            $(this).parent().parent().remove();
            $('#item-pic').val(null);
            $('#pic-main-plus').show();

        });
    })
</script>
<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'cate')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Cate::find()->where(['level'=>1])->asArray()->all(),'name','name'),
        [
                    'prompt'=>'请选择',
        ]
    ) ?>

    <div class="row">
        <div class="col-md-10">
            <label class="control-label" for="item-pic">图片</label>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center title" style="padding:15px;margin: 0">上传图片</p>
                    <p class="well">项目板块图片尺寸要求：<br>
                        1、图片最佳尺寸 450*450px<br>
                        2、单张最大2M
                    </p>
                    <div class="pic-box text-center pic-main-box">
                        <?php if(!empty($model->pic)){ ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="<?php echo Yii::$app->request->baseUrl.$model->pic;?>"   style="max-width: 100%;">
                                    <span class='glyphicon glyphicon-remove-sign remove remove-main'></span>
                                </div>
                            </div>
                            <img src="<?php echo Yii::$app->request->baseUrl.'/img/1.jpg'?>" id="pic-main-plus"  width="100%" style="display: none;max-width: 100%;">
                        <?php }else{ ?>
                            <img src="<?php echo Yii::$app->request->baseUrl.'/img/1.jpg'?>" id="pic-main-plus" width="100%" style="max-width: 100%;">
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 hidden">
                    <?php
                    $pre_url=Yii::$app->request->baseUrl;
                    echo \kartik\widgets\FileInput::widget([
                        'name'=>'Item[pic]',
                        'options'=>[
                            'accept' => 'image/jpg,png,jpeg,gif,JPG,JPEG,GIF,PNG',
                            'multiple'=>false,
                            'id'=>'pic-main'
                        ],
                        'pluginOptions' => [
                            'uploadExtraData' => [
                                'category' => 'Item',
                                'weight'=>0,
                                'size'=>'450@450'
                            ],
                            'maxFileCount' => 1,
                            'showCaption' => true,
                            'showRemove' => true,
                            'uploadUrl' => \yii\helpers\Url::to(['upload/img']),
                            'browseClass' => 'btn btn-info',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  'Select Photo',
                            'initialCaption'=>"选择上传",
                            'overwriteInitial'=>true,
                            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?= $form->field($model, 'pic')->textInput(['maxlength' => true,'class'=>'hidden']) ?>

    <?= $form->field($model, 'pic_src')->textInput(['maxlength' => true,'class'=>'hidden']) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 2,'maxlength' => 25]) ?>
    <?= $form->field($model, 'detail')->textarea(['rows' => 8]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
