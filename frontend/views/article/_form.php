<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>
<script>
    $(function(){
//        $('#pic-main-plus').click(function(){
//            $('#pic-main').click();
//        });
//
//        $('#pic-main').on('fileimageloaded', function(event) {
//            $(this).fileinput('upload');
//        });
        $('#file').on('fileuploaded', function(event, data, previewId, index) {
            var form = data.form, files = data.files, extra = data.extra,
                response = data.response,
                reader = data.reader;
            $('#article-file').val(response);
        });
        $('#file').on('fileclear', function(event, params) {
            $('#article-file').val(null);
        });
        $('#file').on('filereset', function(event, params) {
            $('#article-file').val(null);
        });
        $('.show-upload').click(function(){
            $('.file-box').toggle();
        });
        $('.reset-upload').click(function(){
            $('#file').fileinput('reset');
            $('#article-file').val(null);
        });

    })
</script>
<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12 hidden">

            <?= $form->field($model, 'uid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'article_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?php
            if(isset($_GET['kind'])) $cate_list=\common\models\Cate::find()->where(['level'=>2,'kind'=>$_GET['kind']])->all();
            else   $cate_list=\common\models\Cate::find()->where(['level'=>2])->all();
            ?>
            <?= $form->field($model, 'cate')->dropDownList(\yii\helpers\ArrayHelper::map($cate_list,'id','name'),
                [
                    'prompt'=>'????????????',
                ]
            ) ?>
            <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>
            <?= $form->field($model, 'brief')->textInput(['maxlength' => 250]) ?>

        </div>
        <div class="col-md-12">
            <p><strong>????????????</strong></p>
            <p>
                <a class="btn btn-default show-upload">????????????</a> &#12288;  <?php if(!empty($model->file)) echo '<a class="btn btn-default reset-upload">??????</a> &#12288;????????????(?????????????????????)';?>
            </p>
        </div>
        <div class="col-md-6 file-box" style="display: none">
            <?php
            echo \kartik\widgets\FileInput::widget([
                'name'=>'Article[file]',
                'options'=>[
                    'accept' => 'application/pdf,PDF',
                    'multiple'=>false,
                    'id'=>'file'
                ],
                'pluginOptions' => [
                    'uploadExtraData' => [
                        'category' => 'Article',
                        'weight'=>0,
                    ],
                    'maxFileCount' => 1,
                    'showCaption' => true,
                    'showRemove' => true,
                    'uploadUrl' => \yii\helpers\Url::to(['upload/file']),
                    'browseClass' => 'btn btn-info',
                    'browseLabel' =>  '?????????pdf',
                    'initialCaption'=>"????????????",
                    'overwriteInitial'=>true,
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                ]
            ]);
            ?>
        </div>

        <div class="col-md-12 hidden">
            <hr>
            <?= $form->field($model, 'file')->textInput(['maxlength' => 250]) ?>
        </div>

        <div class="col-md-12">
            <hr>
            <?php echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[
                'clientOptions' => [
                    //??????????????????
                    'initialFrameHeight' => '200',
                    //????????????
                    'lang' =>'zh-cn', //????????? zh-cn
                    //????????????
//                    'toolbars' => [
//                        [
//                            'fullscreen', 'undo', 'redo', '|',
//                            'fontsize',
//                            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
//                            'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
//                            'forecolor', 'backcolor', '|',
//                            'lineheight', '|',
//                            'indent', '|',    'simpleupload',
//                            'justifyleft', //????????????
//                            'justifyright', //????????????
//                            'justifycenter', //????????????
//                            'justifyjustify', //????????????
//                        ],
//                    ]
                ]
            ]);?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '??????' : '??????', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
