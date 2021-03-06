<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .remove{
        position: absolute;
        right:50px;
        top:10px;
        font-size: 30px;
        /*z-index: 999;*/
        color: #f0ad4e;
    }
    .pic-box{
        padding: 10px;
        border: 1px dotted #cccccc;
    }
</style>
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
            $('#banner-pic').val(response);
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
            $('#banner-pic').val(null);
            $('#pic-main-plus').show();

        });
    })
</script>
<div class="banner-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?php
            //    echo $form->field($model, 'cate')->dropDownList(array('1'=>"????????????",'2'=>"????????????",'3'=>"????????????",'4'=>"????????????",'5'=>"????????????",'6'=>"????????????",'7'=>"????????????",'8'=>'????????????'))
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true,'value'=>'http://www.baidu.com','class'=>'hidden']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <label class="control-label" for="banner-pic">??????</label>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center title" style="padding:15px;margin: 0">????????????</p>
                    <?php if($model->cate==2){ ?>
                        <p class="well">?????????????????????????????????<br>
                            1????????????????????? 250*250px<br>
                            2???????????????1M
                        </p>
                    <?php }else{?>
                        <p class="well">??????????????????????????????<br>
                            1??????????????? 1680?????? * 411??????<br>
                            2???????????????1M
                        </p>
                    <?php }?>
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
<!--                <div class="col-md-12">-->
<!--                    <h4 class="text-left font-red"><strong>?????????</strong></h4>-->
<!--                    <p  class="text-left font-gray-d"><strong>???????????????</strong></p>-->
<!--                    <p  class="text-left font-gray-d"> ????????????1680x409px??????????????????????????????????????????????????????1M???</p>-->
<!--                    <p > <small class="font-gray-d">????????????????????????????????????????????????<span class='glyphicon glyphicon-remove-sign'></span>?????????????????????</small>-->
<!--                </div>-->
            </div>
            <div class="row">
                <div class="col-md-12 hidden">
                    <?php
                    $pre_url=Yii::$app->request->baseUrl;
                    echo \kartik\widgets\FileInput::widget([
                        'name'=>'Banner[pic]',
                        'options'=>[
                            'accept' => 'image/jpg,png,jpeg,gif,JPG,JPEG,GIF,PNG',
                            'multiple'=>false,
                            'id'=>'pic-main'
                        ],
                        'pluginOptions' => [
                            'uploadExtraData' => [
                                'category' => 'Banner',
                                'weight'=>0,
                                'size'=>"1680@411",
                            ],
                            'maxFileCount' => 1,
                            'showCaption' => true,
                            'showRemove' => true,
                            'uploadUrl' => \yii\helpers\Url::to(['upload/img']),
                            'browseClass' => 'btn btn-info',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  'Select Photo',
                            'initialCaption'=>"????????????",
                            'overwriteInitial'=>true,
                            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row hidden">
        <div class="col-md-10 col-md-offset-1">
            <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 font-red">
            <br>
            <?php if($model->getErrors()){
                echo '<p class="well">';
                foreach($model->getErrors() as $v)
                {
                    echo $v[0].'<br>';
                }
                echo '</p>';
            }?>
            <div class="form-group">
                <br>
                <?= Html::submitButton($model->isNewRecord ? '??????' : '??????', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
