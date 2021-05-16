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
            //    echo $form->field($model, 'cate')->dropDownList(array('1'=>"首页轮播",'2'=>"牛货轮播",'3'=>"牛事轮播",'4'=>"供求展示",'5'=>"二手牛讯",'6'=>"服务牛讯",'7'=>"其他牛讯",'8'=>'机手大赛'))
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
            <label class="control-label" for="banner-pic">图片</label>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center title" style="padding:15px;margin: 0">上传图片</p>
                    <?php if($model->cate==2){ ?>
                        <p class="well">项目板块图片尺寸要求：<br>
                            1、图片最佳尺寸 250*250px<br>
                            2、单张最大1M
                        </p>
                    <?php }else{?>
                        <p class="well">首页轮播图尺寸要求：<br>
                            1、最佳尺寸 1680像素 * 411像素<br>
                            2、单张最大1M
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
<!--                    <h4 class="text-left font-red"><strong>展示图</strong></h4>-->
<!--                    <p  class="text-left font-gray-d"><strong>温馨提示：</strong></p>-->
<!--                    <p  class="text-left font-gray-d"> 建议使用1680x409px的图片，主需要上传一张即可，单张最大1M。</p>-->
<!--                    <p > <small class="font-gray-d">提示：上传图片后，点击图片右上角<span class='glyphicon glyphicon-remove-sign'></span>按钮可重新上传</small>-->
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
                <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
