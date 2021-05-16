<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PaperLabel */
/* @var $form yii\widgets\ActiveForm */

$this->title = $paper_name;
$this->params['breadcrumbs'][] = ['label' => 'Paper Labels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$save=<<<js
     var content=$('#search').val();
   //  alert(value);
     $.post('search?content='+content,
     function(data){
           $("#check").html(data);
           $("#show-btn").show();

     });
js;
$url=\yii\helpers\Url::to(['csubject/order','paper_name'=>$paper_name,'paper_id'=>$paper_id]) ;
$submit=<<<js
                        var paper_id=$paper_id;
                        var str="";
                        $("#choosen").find("p").each(function(){
                            str+=$(this).attr('id')+"@$@";
                        });
    $.post('save_a?str='+str+'&paper_id='+paper_id,
        function(data){
        //alert(data);
           if(data=="yes"){
             window.location = "$url";   //创建试题成功后 去试卷中排序等
           }else alert('创建失败');
     });
js;

?>
<div class="paper-label-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <h4 class="well" style='color:#ee44bb'>第二步——选择试题</h4>
        </div>
        <div class="col-md-8" >
            <div class="row">
                <div class="col-md-12" >
                    <h4 class="alert alert-info">选择试题</h4>
                    <div id="check" style='padding-top: 20px'>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">
                <div class="col-md-3 col-md-offset-3"  id="show-btn" style="display: none;">
                    <button type="button" class="btn btn-primary btn-block">收起结果</button>
                </div>
                <div class="col-md-3 ">
                    <button type="button" class="btn btn-success btn-block" id="show_shoose-btn">查看已选</button>

                </div>
            </div>
            <div class="row" style="padding-top: 20px;margin-bottom: 10px;">
                <div class="col-md-12" >
                    <div id="choosen" style="display: none"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">

                <div class="col-md-12">
                    <h4 class="alert alert-info">筛选</h4>
                    <?php echo $form->field($model, 'cate')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\LabelCate::find()->all(),'cate','name'),
                        [
                            'prompt'=>'选择题型',
                            'onchange'=>'
                           $.post("listlabel?&cate='.'"+$(this).val(),function(data){
                               $("#check").html(data);
                               $("#show-btn").show();
                           });',
                        ]
                    ) ?>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." id="search">
                           <span class="input-group-btn">
<!--                           <button class="btn btn-default" type="button">Go!</button>-->
                               <?php    echo  Html::button('搜索', ['onclick' =>$save,'class'=>'btn btn-default','type'=>"button",'id'=>'search-btn']);?>
                            </span>
                    </div>
                </div>
                <div class="col-md-12">
                    <h4 class="alert alert-info">操作</h4>
                </div>

            </div>
        </div>
        <div class="col-md-12 text-right">
<!--            <button type="button" class="btn btn-primary btn-lg" id="submit">确认提交</button>-->
            <?php    echo  Html::button('确认提交', ['onclick' =>$submit,'class'=>'btn btn-success btn-lg','type'=>"button",'id'=>'search-btn']);?>

        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
                <script>
                    $(function(){
                        $("#show-btn").click(function(){
                          //  $(this).toggle();
                            var text= $(this).find('.btn').text();
                            if(text=="收起结果") $(this).find('.btn').text('展开结果');
                            if(text=="展开结果") $(this).find('.btn').text('收起结果');
                            $('#check').toggle();
                        });
                        $("#show_shoose-btn").click(function(){
                            //  $(this).toggle();
                            var text= $(this).text();
                            if(text=="查看已选") $(this).text('收起已选');
                            if(text=="收起已选") $(this).text('查看已选');
                            $('#choosen').toggle();
                        });
                    });
                    var tag_count=100;
                    var choosen=$('#choosen');
                    $(document).on('click','#tags_table td',function(){
                        // var tag=$(this).text();
                        var tag=$(this).attr('id');
                        var tag_val=$(this).text();
                        $(this).attr('style','background:#c7c7c7;');
                        var html='<p class="awell well-sm" style="background-color: #f6f6f6" id="'+tag+'">'+tag_val+'<span class="glyphicon glyphicon-trash pull-right" sid="'+tag+'"></span></p>';
                        choosen.append(html);
                        var arr=new Array();
                        var input="";
                        var m=0;  //记录已选择多少个标签
                        var n=0; //标记已选
                        choosen.each(function(){   //显示添加标签
                            $("#choosen").find("p").each(function(){
                                //      var val=$(this).text();
                                var val=$(this).attr('id');
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
                        //   $("#input").attr('value',input);//更新input框中值
                        removeChoosen();//在每次添加标签后  刷新供使用的删除标签功能
                    });

                    function removeChoosen(){  //在每次添加标签后  刷新供使用的删除标签功能
                        var choosen= $("#choosen");
                        choosen.find('span').click(function(){  //删除添加的标签
                           // var val=$(this).text();
                            var val_id=$(this).attr('sid');
                            $(this).parent().remove();
                            $("#tags_table").each(function(){
                                $("#tags_table").find("td").each(function(){
                                    if(val_id==$(this).attr('id')){
                                        $(this).attr('style','background:none;cursor:hand;');
                                    }
                                });
                            });
                            var arr=new Array();
                            var input="";
                            var m=0;   //记录已选择多少个标签
                            $("#choosen").each(function(){
                                $("#choosen").find("p").each(function(){
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
                        //    $("#cepingreport-containtag").attr('value',input);//更新input框中值
                        });
                    }



                </script>

                <!--    <div class="row"> 勾选题目-->
                <!---->
                <!--        --><?php //foreach($labelModels as $v){ ?>
                <!--            <div class="col-md-4" style="height:50px">-->
                <!---->
                <!--                <label class="checkbox-inline">-->
                <!--                    <input type="checkbox" id="--><?php //echo $v->label_id?><!--" name="Paper[--><?php //echo $v->label_id?><!--]" value="--><?php //echo$v->label_name?><!--">-->
                <!--                    --><?php //echo$v->label_name?><!--:-->
                <!--                </label>-->
                <!--                <br>-->
                <!--            </div>-->
                <!--        --><?php // }?>
                <!--    </div>-->