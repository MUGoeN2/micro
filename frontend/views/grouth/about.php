<?php

$this->title = '关于我们';
?>

<script>
    $(function(){
        $('#ask').click(function(){
            var uid='<?php if(isset(Yii::$app->user->id)) echo Yii::$app->user->id;?>';
            var val=$('#ask-input').val();
            if(uid=='') {alert("清先登录!");     return false;}
            if(val=='') {alert("请先输入问题");   return false;}
            $.post('<?php echo \yii\helpers\Url::to(['ask/ask'])?>?question='+val,function(data){
                if(data =='yes'){
                    alert('您的问题我们已经收到！我们会尽快为您解答。');
                }
                else if(data=='asked'){
                    alert('请过一段时间再提问！');
                }
                else{
                    alert(data);
                    alert('抱歉！服务器开小差了');
                }
            });
        });
        $('.name').click(function(){
            var name= $(this).text();
            $(this).parent().attr('class','list-group-item active');
            $(this).parent().siblings().attr('class','list-group-item');
           // alert(name);
            $.post('click?name='+name,function(data){
                $('#content').html('');
                $('#content').html(data);
            });
        });
    })
</script>

<div class="row text-center"  style="padding: 30px 0 30px 0">
    <div class="col-md-12" style="padding: 15px ">
        <h4><span style="color: #8c8c8c">有推广运营问题？&nbsp;给Memo提问，</span>行业专家<span style="color: #8c8c8c">为您解答！</span></h4>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="您的问题？" id="ask-input">
             <span class="input-group-btn">
             <button class="btn btn-info" type="button" id="ask">提问</button>
             </span>
        </div>
    </div>
    <hr>
</div>

<div class="row" style="background-color: #fff;border-radius: 10px;min-height: 250px">
    <div class="col-md-2"  style="padding: 30px 20px;">
        <div class="list-group">
            <button type="button" class="list-group-item">
                <span class="glyphicon glyphicon-th-large"></span>&#12288;关于我们
            </button>
            <button type="button" class="list-group-item active"><span class="glyphicon glyphicon-home"></span>&#12288;<span class="name">公司资料</span></button>
            <button type="button" class="list-group-item "><span class="glyphicon glyphicon-send"></span>&#12288;<span class="name">案例相关</span></button>
            <button type="button" class="list-group-item "><span class="glyphicon glyphicon-cloud"></span>&#12288;<span class="name">加入我们</span></button>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-12" style="background-color: #fff;padding:20px;min-height: 250px">
                <div class="row" style="padding:10px 5%" id="content">
                <?php if(isset($content)) echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>