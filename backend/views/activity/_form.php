<?php

use yii\web\View;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

//$this->registerCssFile('@web/test/uploadify.css');
//$this->registerJsFile('@web/test/jquery.uploadify.js', ['depends' => 'yii\web\YiiAsset']);
/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .control-label{
        text-align: center;
    }
    .row{
        margin-bottom: 30px;
    }
    .form-group label{
        font-size: 18px;
    }
    #tags_table tr td{
        cursor:pointer;
        width:15%;
    }
</style>
<script type="text/javascript">
    <?php $timestamp = time();?>
    $(function() {
        $('#publish').click(function(){
            $('#activity-status').attr('value','1');
        });
        $('#save').click(function(){
            $('#activity-status').attr('value','2');
//            var ue = UE.getEditor('#activity-content');
//            var html = ue.getContent();
//            alert(html);
        });

        $('#tags_table').find('td').click(function(){
            var tag=$(this).text();
            var choosen= $("#choosen");
            $(this).attr('style','background:#f6f6f6;');
            var html='<span class="btn btn-success" style="margin-right: 10px">'+tag+'</span>';
            var arr=new Array();
            var input="";
            var m=0;  //记录已选择多少个标签
            var n=0; //标记已选

            choosen.append(html);

            choosen.each(function(){
                $("#choosen").find("span").each(function(){
                    var val=$(this).text();
                    if(val==tag){
                        n++;
                        if(n==2){ //已选则删除
                            $(this).remove();
                            return false;
                        }
                    }
                    if(m==6){
                        alert("最多只能选择6个标签");
                        $(this).last().remove();
                        return false;
                    }
                    arr[m]=$(this).text();
                    m++;
                });
            });
            for(var i=0;i<arr.length;i++){
                if(arr[i]!=null){
                    input=input+"@"+arr[i];
                }
            }
            $("#activity-label").attr('value',input);
            choosen.find('span').click(function(){
                var val=$(this).text();
                $(this).remove();
                $("#tags_table").each(function(){
                    $("#tags_table").find("td").each(function(){
                        if(val==$(this).text()){
                            $(this).attr('style','background:none;cursor:hand;');
                        }
                    });
                });
                var arr=new Array();
                var input="";
                var m=0;   //记录已选择多少个标签
                $("#choosen").each(function(){
                    $("#choosen").find("span").each(function(){
                        if(m==6){
                            alert("最多只能选择6个标签");
                            $(this).last().remove();
                            return false;
                        }
                        arr[m]=$(this).text();
                        m++;
                    });
                });
                for(var i=0;i<arr.length;i++){
                    if(arr[i]!=null){
                        input=input+"@"+arr[i];
                    }
                }
                $("#activity-label").attr('value',input);
            });
        });
        $(document).ready(function(){
            var content=$('.field-activity-content');
            var title=$('.field-activity-title');
            var pic=$('.field-activity-pic');
            content.find('.col-sm-3').attr('class','col-sm-2 text-center');
            content.find('.col-sm-9').attr('class','col-sm-11 col-sm-offset-1');
            title.find('.col-sm-3').attr('class','col-sm-2 text-center');
            title.find('.col-sm-9').attr('class','col-sm-10');
            pic.find('.col-sm-3').attr('class','col-sm-2 text-center');
            pic.find('.col-sm-9').attr('class','col-sm-6');


        });

    });
</script>
<?php
$save=<<<js
     var activityId=$model->activityId;
     var title=$('#activity-title').val();
     var status=$('#activity-status').val();
     var startTime=$('#activity-starttime').val();
     var endTime=$('#activity-endtime').val();
     var addresspro=$('#activity-addresspro').val();
     var addresscity=$('#activity-addresscity').val();
     var addressdistrict=$('#activity-addressdistrict').val();
     var addressdetail=$('#activity-addressdetail').val();
     var limit=$('#activity-limit').val();
     var level=$('#activity-level').val();
     var content="暂留";//$('#activity-content').
     var label=$('#activity-label').val();
     var topic=$('#activity-topic').val();
     var form=$('#activity-form').val();
     $.post('save?&activityId='+activityId+'&title='+title+'&status='+status+'&startTime='+startTime+'&endTime='+endTime+'&addresspro='+addresspro+
     '&addresscity='+addresscity+'&addressdistrict='+addressdistrict+'&addressdetail='+addressdetail+'&limit='+limit+
     '&level='+level+'&content='+content+'&label='+label+'&topic='+topic+'&form='+form,
     function(data){
      alert(data);
     })
js;
?>

<div class="activity-form">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
//                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-9',
                'error' => '',
                'hint' => '',
            ],
        ]]); ?>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-12 hidden">
            <?= $form->field($model, 'activityId')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
    </div>
    <div class="row" style="margin-top:50px">
        <div class="col-lg-12">
            <?php
            $img=\common\models\Img::find()->where(['id'=>$model->pic])->one();
            if(!empty($img)&&$img->img_small!="small")
                $haibao=Yii::$app->request->baseUrl.'/'.$img->img_small;
            else $haibao=Yii::$app->request->baseUrl.'/img/back.png';

            echo $form->field($model, 'pic')->widget(\kartik\widgets\FileInput::classname(), [
                'options'=>[
                    'accept' => 'image/*',
                    'multiple'=>false,
                ],
                'pluginOptions' => [
                    'uploadUrl' => \yii\helpers\Url::to(['activity/uploadhaibao']),
                    'uploadExtraData' => [
                        'timestamp' => time(),
                        'category' => 'haibao',
                        'activityId'=>$model->activityId,
                        'maxFileCount' => 1,
                    ],
                    'initialPreview'=>[
                        Html::img($haibao, ['class'=>'file-preview-image', 'alt'=>'海报', 'title'=>'海报','width'=>'100%']),
                    ],
                    'initialCaption'=>"选择图片后请点击上传",
                    'overwriteInitial'=>true,
                    'browseClass' => 'btn btn-danger',
                    'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <hr style="border-bottom:solid 1px #ee2352;height:60px;margin:0;background-color: #fff"/>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?php
            echo $form->field($model, 'startTime')->widget(\kartik\datetime\DateTimePicker::className(),[
                'name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => '选择日期'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd h:i:s',
                    'todayHighlight' => true
                ]
            ]);?>
        </div>
        <div class="col-lg-6">
            <?php
            echo $form->field($model, 'endTime')->widget(\kartik\datetime\DateTimePicker::className(),[
                'name' => 'check_issue_date',
                'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => '选择日期'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd h:i:s',
                    'todayHighlight' => true
                ]
            ]);?>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?php echo $form->field($model, 'addressPro')->dropDownList(ArrayHelper::map(\common\models\AddressProvince::find()->all(),'code','short_name'),
                [
                    'prompt'=>'请选择地区',
                    'onchange'=>'
                   $.post("listcity?&proid='.'"+$(this).val(),function(data){
                       $("select#activity-addresscity").html(data);
                   });',
                ]
            )?>
        </div>
        <div class="col-lg-6">
            <?php echo $form->field($model, 'addressCity')->dropDownList(ArrayHelper::map(\common\models\AddressCity::find()->all(),'code','name'),
                [
                    'prompt'=>'请选择地区',
                    'onchange'=>'
                           $.post("listdistrict?&cityid='.'"+$(this).val(),function(data){
                               $("select#activity-addressdistrict").html(data);
                           });',
                ]
            ) ?>
        </div>
        <div class="col-lg-6 col-lg-offset-6">
            <?php echo $form->field($model, 'addressDistrict')->dropDownList(ArrayHelper::map(\common\models\AddressDistrict::find()->all(),'code','name'),
                [
                    'prompt'=>'请选择',
                ]
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'addressDetail')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'limit')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'form')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <!--            --><?//= $form->field($model, 'applyTime')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <hr style="border-bottom:solid 1px #ee2352;height:60px;background-color: #fff"/>
    </div>
    <div class="row">
        <div class="col-lg-6 hidden">
            <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3 col-lg-offset-1 text-left">
            <button type="button" class="btn " style="background-color: #ee2352;color:#fff">添加标签 </button>
            <button type="button" class="btn btn-default">自定义<small><span class="glyphicon glyphicon-plus"></span></small></button>
        </div>
        <div class="col-lg-8"  id="choosen">
            <?php if(!empty($model->label)){
                $arr=explode('@',$model->label);
//                p($arr);
                foreach($arr as $v){
                    echo $v==""?" ":"<span class='btn btn-success' style='margin-right: 10px'>$v</span>";
                }
            }?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <?php $tags=array('IT','互联网','移动互联网','电商','创业','创新','科技','公益','慈善','环保','分享会','志愿者');?>
            <?php
            echo "<table class='table table-bordered' id='tags_table'  style='text-align:center;margin-top: 20px' >";
            echo "<tr>";
            $a=0;
            foreach($tags as $v){
                $a++;
                echo "<td>$v</td>";
                if($a%6==0) {  echo "</tr><tr>"; }
            }
            echo "</tr>";
            echo "</table>";
            ?>
        </div>
    </div>
    <div class="row" style="margin-bottom: 0">
        <div class="col-lg-12" >
            <?php echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[
                'clientOptions' => [
                    //编辑区域大小
                    'initialFrameHeight' => '200',
                    //设置语言
                    'lang' =>'zh-cn', //中文为 zh-cn
                    //定制菜单
                    'toolbars' => [
                        [
                            'fullscreen', 'source', 'undo', 'redo', '|',
                            'fontsize',
                            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                            'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                            'forecolor', 'backcolor', '|',
                            'lineheight', '|',
                            'indent', '|',    'simpleupload',
                            'justifyleft', //居左对齐
                            'justifyright', //居右对齐
                            'justifycenter', //居中对齐
                            'justifyjustify', //两端对齐
                        ],
                    ]
                ]
            ]);?>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-sm-6 text-right">
                <?php    echo  Html::button('保存', ['onclick' =>$save,'class'=>'btn btn-default','id'=>'save','style'=>"width: 120px"]);?>
            </div>
            <div class="col-sm-6 text-left">
                <!--                --><?//= Html::submitButton($model->isNewRecord ? '创建' : '发布', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <button type="submit" id="publish" class="btn btn-danger" style="width: 120px">发布</button>
            </div>
        </div>
    </div>
    <?php  p($model->getErrors())?>
    <?php ActiveForm::end(); ?>

</div>



