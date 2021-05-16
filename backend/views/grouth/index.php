<?php $paperId=\common\models\CepingPaper::find()->where(['status'=>1])->orderBy('weight DESC')->one()->paperId; ?>
<script>
    //提问
    $(function(){
        $('#ask').click(function(){
            var uid='<?php echo Yii::$app->user->id;?>';
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
    });
</script>
<div class="row" style="margin-top: 50px">
    <?php echo $this->render('lunbo')?>
</div>

<div class="row"  style="background-color: #fafafa;padding: 30px 0">
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h4>刚认识 GrowthMemo？让Memo给您一份专业的推广运营测评！</h4>
            <p><a class="btn btn-primary btn-lg " href="<?php echo \yii\helpers\Url::to(['csubject/test','paperId'=>$paperId])?>" role="button">开始测评</a></p>
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <img src='<?php  echo Yii::$app->request->baseUrl;?>/img/jianjie.gif' width="100%">
    </div>
</div>

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
