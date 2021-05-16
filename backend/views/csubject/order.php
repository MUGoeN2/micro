<?php
use \yii\helpers\Url;


$this->title = '试题排序与跳转设置';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['cepinglabel/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

</style>
<?php
$submit=<<<js
var paper_id=$paper_id;
var arr=new Array();
var flag=0;
var i=0;
$('.rank').each(function(){ //遍历题号选项选的值
//alert($(this).val());
if($(this).val()==0) {
                  alert('问题：“'+$(this).attr('question')+'”未选择序号');
                  flag=1;
                  return false;
}
else {
arr[i]=$(this).attr('id')+"@a@"+$(this).val();    //记录id+题序号
i++;
}
});
var arr_jump=new Array();
var j=0;
$('.jump').each(function(){          //遍历跳转选项选的值
//alert($(this).val());
if($(this).val()!=0) {
           arr_jump[j]=$(this).attr('id')+"@a@"+$(this).val();   //记录id+题序号
           j++;
}
});
//alert(arr_jump);
if(flag==0){
//alert(arr);
arr=JSON.stringify(arr);
arr_jump=JSON.stringify(arr_jump);
$.post("save_order?arr="+arr+"&arr_jump="+arr_jump+"&paper_id="+paper_id,function(data){
   alert(data);
   location.reload();
});
}
else alert('还没有排序~');
js;

//$submit=<<<js
//var paper_id=$paper_id;
//var str_a="";
//var str_b="";
//var flag=0;
//$('.rank').each(function(){
////alert($(this).val());
//if($(this).val()==0) {
//                  alert('问题：“'+$(this).attr('question')+'”未选择序号');
//                  flag=1;
//}
//else {
//str_a+=$(this).attr('id')+"@@"+$(this).val()+"(#)";
//}
//});
//
//$('.jump').each(function(){
////alert($(this).val());
//if($(this).val()!=0) {
//           str_b+=$(this).attr('id')+"@@"+$(this).val()+"(#)";
//}
//});
////alert(arr_jump);
//if(flag==0){
//$.post("save_order?arr="+str_a+"&arr_jump="+str_a+"&paper_id="+paper_id,function(data){
//alert(data);
//});
//}
//else alert('请先排好题号');
//js;
?>
<style>
    .order-box{
        display: none;
    }
    .jump-box{
        display: none;
    }
</style>
<div class="row">
    <h5 class="text-center">欢迎：<?php  echo Yii::$app->user->identity->username; ?>&#12288;&#12288;
    </h5>
</div>
<div class="row">

    <div class="col-md-12 text-center">
        <h4 class="well" style='color:#ee44bb'>第三步——为试题排序</h4>
    </div>
    <div class="col-md-9">
        <!--        <div class="alert alert-info">试题排序</div>-->
        <div class="alert alert-info">试卷：<?php echo $paper_name ?></div>
        <table class="table table-bordered">
            <tr ><th style="text-align: center">排序</th><th style="text-align: center">题目</th><th style="text-align: center">跳转</th></tr>
            <?php foreach($model as $v){ ?>

        </table>
        <table class="table table-bordered">
            <tr><th class="text-center order-box">

                    <select class="form-control rank" name="weight" id="<?php echo $v->id; ?>"  question="<?php echo $v->label_name ?>">
                      <?php if(isset($v->rank))
                          echo "<option   value='$v->rank'>$v->rank</option>";
                          else echo '<option   value="0">选择序号</option>';
                      ?>

                        <?php for($i=1;$i<=$count;$i++){
                            echo "<option value='".$i."' class='choice'>$i</option>";}
                        ?>
                    </select>
                </th>
                <th style="width: 70%" id="<?php echo $v->label_id; ?>"><?php echo $v->label_name; ?></th>

                <th class="text-center jump-box">
                </th>
            </tr>
            <?php   $answers=\common\models\CepingSubject::find()->where(['paperId'=>$v->paperId,'parent_id'=>$v->label_id])->all(); //如果是答案
                foreach($answers as $an){ ?>
                <tr><td class="order-box"></td><td id="<?php echo  $an->label_id;?>"><?php echo  $an->label_name;?></td><td class="jump-box">
                        <select class="form-control jump" name="jump" id="<?php echo $an->id; ?>" >
                            <?php if(!empty($an->foreign_id))
                                 echo "<option   value='".$an->foreign_id."'>". $an->foreign_id." </option>";
                            else echo '<option   value="0">跳转到</option>';
                            ?>

                            <?php for($i=1;$i<=$count;$i++){
                                echo "<option value='".$i."' class='choice'>$i</option>";}
                            ?>
                        </select>
                    </td></tr>

            <?php   }    } ?>
        </table>

    </div>
    <div class="col-md-3">
        <div class="alert alert-info">操作</div>
        <hr>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default order-btn">设置排序</button>
            </div>
        </div>

        <hr>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default jump-btn">设置跳转</button>
            </div>
        </div>
        <hr>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a href="<?php echo Url::to(['csubject/showpaper','paperId'=>$paper_id])?>" target="_blank"><button type="button" class="btn btn-default btn-lg">查看详情</button></a>
            </div>
        </div>
        <hr>
        <div class="btn-group btn-group-justified" role="group" aria-label="..." style="margin-top: 150px;">
            <div class="btn-group" role="group">
                <?php    echo  \yii\helpers\Html::button('保存设置', ['onclick' =>$submit,'class'=>'btn btn-primary btn-lg','type'=>"button",'id'=>'sure']);?>
            </div>
        </div>

    </div>
</div>
<script>
    $(function(){

        $(".rank").change(function(){
            var val=$(this).val();  // alert(val);
            var closest=$(this).closest('table');
            closest.siblings().find('.rank').each(function(){
                $(this).find('.choice').each(function(){
                    if($(this).attr('value')==val){
                        $(this).attr('class','choice hidden');
                    }
                });
            });

        });
//        alert(Array.complement(a,b));
        $('.order-btn').click(function(){
            $('.order-box').toggle();
        });
        $('.jump-btn').click(function(){
            $('.jump-box').toggle();
        });
        $('.re-jump').click(function(){
          //  alert(1);
         //   $('.jump').text('跳转到');
            $('.jump').val('0');
        });
        $('.btn-default ').click(function(){
             $('.btn-info ').addClass('btn-default');
             $('.btn-info ').removeClass('btn-info');
             $(this).removeClass('btn-default');
             $(this).addClass('btn-info');

        });
    });
</script>
