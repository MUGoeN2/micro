<?php
use \yii\bootstrap\Alert;
use  \yii\widgets\ActiveForm;
$this->title = 'GrowthMemo专业测评';
?>
<?php $paperId=\common\models\CepingPaper::find()->where(['status'=>1])->orderBy('weight DESC')->one()->paperId; ?>
<script>
    //提问
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
    });
</script>
<div class="row" style="margin-top: 50px">
    <?php echo $this->render('lunbo')?>
</div>
<div class="row">
    <div class="col-md-12 text-center">
        <?php if(Yii::$app->getSession()->hasFlash('ok')) {
            echo  Alert::widget([
                'options' => [
                    'class' => 'alert-success', //这里是提示框的class
                ],
                'body' => Yii::$app->getSession()->getFlash('ok'), //消息体
            ]);
        } ?>
    </div>
</div>
<div class="row"  style="background-color: #fafafa;padding: 30px 0">
    <div class="container" >
        <div class="row">
            <div class="col-md-12 text-center" style="padding: 15px;color: #8c8c8c ">
                <h4 style="color:#595a5b">刚认识 GrowthMemo？让Memo给您一份专业的推广运营测评！</h4>
                <p><small>（适用对象：企业负责人、市场推广相关人员、自媒体、对推广感兴趣的朋友）</small></p>
            </div>
            <div class="col-md-12 text-center">
                <p>
                    <a class="btn btn-info btn-lg " href="<?php echo \yii\helpers\Url::to(['csubject/test','paperId'=>$paperId])?>" role="button" style="width: 200px;border: none">开始测评</a>
                    <?php if(Yii::$app->user->isGuest&&$applied==false){ ?>
                        <span class="visible-md"> &#12288;</span>  <span class="visible-xs"><br></span>
                        <button type="button" class="btn btn-info  btn-lg" data-toggle="modal" data-target="#myModal"  style="width: 200px;border: none;background-color: #00b37b">申请内测</button>
                    <?php }?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <img src='<?php  echo Yii::$app->request->baseUrl;?>/img/jianjie.gif' width="100%">
    </div>
</div>

<div class="row text-center"  style="background-color: #fafafa;padding: 30px 0 100px 0">
    <div class="col-md-12" style="padding: 15px ">
        <h4><span style="color: #8c8c8c">有推广运营问题？&nbsp;给Memo提问，</span>行业专家<span style="color: #8c8c8c">为您解答！</span></h4>
        <p><small style="color: #8c8c8c"> （建议测评后提问，更有针对性）</small></p>

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


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">&#12288;申请内测</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php $form = ActiveForm::begin(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-12">
                            <?php echo $form->field($model, 'from')->textInput(['maxlength' => true])?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->field($model, 'position')->textInput(['maxlength' => true])?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->field($model, 'city')->textInput(['maxlength' => true])?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $form->field($model, 'tel')->textInput(['maxlength' => true])?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className(), [
                                'template'=>'{input}{image}',
                                'captchaAction'=>'site/captcha',
                                'imageOptions'=>['title'=>'点击换图','alt'=>'点击图',
                                    'style'=>'cursor:pointer']
                            ])?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <?= \yii\helpers\Html::submitButton(  '提交试用申请', ['class' => 'btn btn-info btn-block' ]) ?>

            </div>
            <?php  ActiveForm::end();?>
        </div>
    </div>
</div>