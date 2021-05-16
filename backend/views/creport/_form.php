<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use \common\models\Level;
use \common\models\CepingPaper;
use \common\models\CepingLabel;
/* @var $this yii\web\View */
/* @var $model common\models\CepingReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ceping-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'level')->dropDownList(array(''=>'请选择','网站'=>'网站','APP'=>'APP','公众号'=>'公众号','技术营销'=>'技术营销','社会化营销'=>'社会化营销','PR'=>'PR','广告'=>'广告','地推'=>'地推'))?>
        </div>
    </div>

    <?php echo $form->field($model,'content')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>




    <div class="row" style="margin-bottom: 30px">
        <div class="col-md-6">
            <?php echo $form->field($model, 'paperId')->dropDownList(ArrayHelper::map(CepingPaper::find()->all(),'paperId','paper_name'),
                ['prompt'=>'请选择对应试卷',
                    'onchange'=>'
                   $.post("listlabel?&paperId='.'"+$(this).val(),function(data){
                           $("select#cepingreport-content1_tag").html(data);
                           $("select#cepingreport-content2_tag").html(data);
                           $("select#cepingreport-content3_tag").html(data);
                           $("select#cepingreport-content4_tag").html(data);
                           $("select#cepingreport-content5_tag").html(data);
                           $("select#cepingreport-content6_tag").html(data);
                             $("#abc").html(data);
                              $(".tag-box-b").html();
                                  $(".tag-box-a").html();
                   });',]
            )?>
        </div>
         <div class="col-md-6" >
             <div class="form-group field-cepingreport-paperid">
             <label class="control-label" for="abc">查看所有标签号码<small>（需先选择试卷号</small>）</label>
                 <select id="abc" class="form-control">
                     <option>查看所有标签编号</option>
                 </select>
         </div>
         </div>
    </div>
    <div class="row hidden">
        <div class="col-md-6">
            <?= $form->field($model, 'containTag')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'removeTag')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn tag-box-a-btn" style="background-color: #ee2352;color:#fff">包含标签+</button>
                </div>

                <div class="col-md-9"  id="choosen">
                    <?php if(!empty($model->containTag)){
                        $arr=explode('@',$model->containTag);
//                p($arr);
                        foreach($arr as $v){
                            echo $v==""?" ":"<span class='btn btn-success' style='margin-right: 10px'>$v</span>";
                        }
                    }?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-3">
                    <button type="button" class="btn tag-box-b-btn" style="background-color: #ee2352;color:#fff">排除标签+</button>
                </div>

                <div class="col-md-9"  id="choosen_a">
                    <?php if(!empty($model->removeTag)){
                        $arr=explode('@',$model->removeTag);
//                p($arr);
                        foreach($arr as $v){
                            echo $v==""?" ":"<span class='btn btn-success' style='margin-right: 10px'>$v</span>";
                        }
                    }?>
                </div>
            </div>

        </div>
    </div>
<!--    存放动态标签table-->
   <div class="row">
       <div class="col-md-12">
           <div class="row ">

               <div class="col-md-12 tag-box-a text-center "  id="tags_table" style="display: none">

               </div>
           </div>
           <div class="row">

               <div class="col-md-12 tag-box-b  text-center "  id="tags_table_a" style="display: none">

               </div>
           </div>
       </div>
   </div>
    <hr>

    <?php echo $form->field($model,'content_1')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_1_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content1_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>
    <?php echo $form->field($model,'content_2')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_2_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content2_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>
    <hr>
    <?php echo $form->field($model,'content_3')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_3_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content3_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>

    <hr>
    <?php echo $form->field($model,'content_4')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_4_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content4_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>

    <hr>

    <?php echo $form->field($model,'content_5')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_5_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content5_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>
    <hr>

    <?php echo $form->field($model,'content_6')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
        ]]);?>



    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'content_6_title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'content6_tag')->dropDownList(ArrayHelper::map(CepingLabel::find()->all(),'id','label_name'),
                ['prompt'=>'对应标签',])?>
        </div>
    </div>
    <hr>
    <div class="row hidden">
        <div class="col-md-6">
            <?= $form->field($model, 'weight')->dropDownList(['1' => '1', '2' => '2', '3' => '3']); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList(['1' => '正常', '2' => '异常', '3' => '其他']); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




<script>
    var tag_count=6;
    var choosen= $("#choosen");
    var choosen_a= $("#choosen_a");
    $(function() {

//        $('#tags_table').find('td').click(function(){
            $(document).on('click','#tags_table td',function(){

            var tag=$(this).text();
            $(this).attr('style','background:#c7c7c7;');
            var html='<span class="btn btn-success" style="margin-right: 10px">'+tag+'</span>';
            choosen.append(html);
            var arr=new Array();
            var input="";
            var m=0;  //记录已选择多少个标签
            var n=0; //标记已选
            choosen.each(function(){   //显示添加标签
                $("#choosen").find("span").each(function(){
                    var val=$(this).text();
                    if(val==tag){
                        n++;
                        if(n==2){ //已选则删除
                            alert("此标签已有");
                            $(this).remove();
                            return false;
                        }
                    }
                    if(m==tag_count){
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
            $("#cepingreport-containtag").attr('value',input);//更新input框中值
            removeChoosen();//在每次添加标签后  刷新供使用的删除标签功能
        });
            $(document).on('click','#tags_table_a td',function(){
                var tag=$(this).text();

                $(this).attr('style','background:#c7c7c7;');
                var html='<span class="btn btn-success" style="margin-right: 10px">'+tag+'</span>';
                choosen_a.append(html);
                var arr=new Array();
                var input="";
                var m=0;  //记录已选择多少个标签
                var n=0; //标记已选
                choosen_a.each(function(){   //显示添加标签
                    $("#choosen_a").find("span").each(function(){
                        var val=$(this).text();
                        if(val==tag){
                            n++;
                            if(n==2){ //已选则删除
                                alert("此标签已有");
                                $(this).remove();
                                return false;
                            }
                        }
                        if(m==tag_count){
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
                $("#cepingreport-removetag").attr('value',input);//更新input框中值
                removeChoosen_a();//在每次添加标签后  刷新供使用的删除标签功能

        });

        var tip=0;
        $('.tag-box-a-btn').click(function(){
            var paper_id=$('#cepingreport-paperid').val();
            $.post('gettags?paper_id='+paper_id,function(data){
                 var cc=' <h4 class="alert alert-info">选择<strong style="color: #ee2352">包含</strong>标签</h4>';
                $('.tag-box-a').html(cc+data);
            });
            $('.tag-box-a').toggle();
            $('.tag-box-b').html('');
        });
        $('.tag-box-b-btn').click(function(){
            var paper_id=$('#cepingreport-paperid').val();
            var cc=' <h4 class="alert alert-info">选择<strong style="color: #ee2352">排除</strong>标签</h4>';
            $.post('gettags?paper_id='+paper_id,function(data){
                $('.tag-box-b').html(cc+data);
            });
            $('.tag-box-b').toggle();
            $('.tag-box-a').html('');
        });

        removeChoosen();
        removeChoosen_a();
    });
    function removeChoosen(){  //在每次添加标签后  刷新供使用的删除标签功能
        var choosen= $("#choosen");
        choosen.find('span').click(function(){  //删除添加的标签
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
                    if(m==tag_count){
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
            $("#cepingreport-containtag").attr('value',input);//更新input框中值
        });
    }
    function removeChoosen_a(){  //在每次添加标签后  刷新供使用的删除标签功能
        var choosen_a= $("#choosen_a");
        choosen_a.find('span').click(function(){  //删除添加的标签
            var val=$(this).text();
            $(this).remove();
            $("#tags_table_a").each(function(){
                $("#tags_table_a").find("td").each(function(){
                    if(val==$(this).text()){
                        $(this).attr('style','background:none;cursor:hand;');
                    }
                });
            });
            var arr=new Array();
            var input="";
            var m=0;   //记录已选择多少个标签
            $("#choosen_a").each(function(){
                $("#choosen_a").find("span").each(function(){
                    if(m==tag_count){
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
            $("#cepingreport-removetag").attr('value',input);//更新input框中值
        });
    }
</script>


