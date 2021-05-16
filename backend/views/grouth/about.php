<script>
    $(function(){
        $('#ask').click(function(){
            var uid='<?php if(isset(Yii::$app->user->id)) echo Yii::$app->user->id;?>';
            var val=$('#ask-input').val();
            if(uid=='') {alert("清先登录!");     return false;}
            if(val=='') {alert("请先输入问题");   return false;}
            $.post('ask/ask?question='+val,function(data){
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
            $.post('click?name='+name,function(data){
                $('#content').html('');
                $('#content').html(data);
            });
        });
    })
</script>

<div class="row text-center"  style="background-color: #fafafa;padding: 30px 0">
    <h3>有推广运营问题？给Memo提问，行业专家为您解答！</h3>
    <div class="col-md-4 col-md-offset-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="您的问题？" id="ask-input">
             <span class="input-group-btn">
             <button class="btn btn-primary" type="button" id="ask">提问</button>
             </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2" >
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px;height: 250px">
                <h3 class="text-center" >关于我们</h3>
                <hr style="margin: 5px">
                <h4 class="text-center" ><button type="button" class="btn  btn-primary name">公司资料</button></h4>

                <hr style="margin: 5px">
                <h4 class="text-center" ><button type="button" class="btn  btn-primary name">案例相关</button></h4>

                <hr style="margin: 5px">
                <h4 class="text-center" ><button type="button" class="btn  btn-primary name">加入我们</button></h4>

            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px">
                <div class="row" style="padding:10px 5%;min-height: 250px" id="content">
                <?php if(isset($content)) echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>