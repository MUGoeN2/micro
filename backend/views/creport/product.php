<?php
use \yii\helpers\Url;
?>
<div class="row">
    <hr style="margin: 10px;border: none"/>
    <div class="col-md-12" style="margin-bottom: 20px">
        <h4><strong>我们提供以下不同版本供您选择:</strong></h4>
    </div>
    <div class="col-md-4" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">体验版</a>
            <ul class="list-group" style="height: 250px;background-color: #fff">
                <li class="list-group-item" style="border: none"><strong>您将获得：</strong></li>
                <li class="list-group-item" style="border: none">推广测评报告“概述”部分内容</li>
                <li class="list-group-item" style="border: none"><small>（仅包括1个大类概述版内容）</small></li>
                <li class="list-group-item" style="border: none">提问一定概率被回答</li>
                <li class="list-group-item" style="border: none">推广方法订阅干货</li>

            </ul>
            <div class="text-center alert alert-default" style="background-color: #e4e4e4">
                <ul class="list-inline" style="padding:5px 0">
                    <li style="font-size: 20px">免费版</li>
                    <li><a href="<?php echo Url::to(['free','paper_id'=>$paper_id,'product_id'=>$product_id])?>">
                   <button type="button"  class="btn btn-primary">点击查看</button>
                        </a>
                    </li>
                    </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">专业版</a>
            <ul class="list-group" style="height: 250px;background-color: #fff">
                <li class="list-group-item" style="border: none"><strong>您将获得 体验版 所有内容，以及：</strong></li>
                <li class="list-group-item" style="border: none">推广测评报告“概述”全部内容</li>
                <li class="list-group-item" style="border: none"><small>（从8个大类，100+个小类，1000+个推广TIPS，从中精准匹配您的定制报告）</small></li>
                <li class="list-group-item" style="border: none">推广测评报告“详细版”全部内容</li>
                <li class="list-group-item" style="border: none">提问大概率被回答</li>
            </ul>
            <div class=" text-center alert alert-default" style="background-color: #e4e4e4">
                <ul class="list-inline" >
                    <li class=" btn text-left" style="border: none"><strong>限时价：</strong><br>原价：699元</li>
                    <li class="" style="border: none;"><a class="btn" style="font-size: 20px;color: #000000">299元</a>
                       <?php $uid=Yii::$app->user->id;   //查询是否付费 如果已付费则可查看
                             $result=\common\models\Shopcart::find()->where(['uid'=>$uid,'product_id'=>$product_id,'status'=>1])->one();
                           if(!empty($result)){
                            echo "<a class='btn btn-primary' href='result_back?paper_id=$paper_id&product_id=$product_id'>点击查看</a>";
                           }else{
                       ?>
                        <!-- Button trigger modal -->
                        <button type="button" id="buy" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            点击购买
                        </button>
                        <?php } ?>
                    </li>
                    <li class="" style="border: none"></li>
                </ul>

            </div>
        </div>
    </div>


    <div class="col-md-4" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">**版</a>
            <ul class="list-group" style="height: 250px;background-color: #fff">
                <li class="list-group-item" style="border: none"><strong>努力开发中……</strong></li>
            </ul>
            <h3 class="text-center alert alert-default" style="background-color: #e4e4e4">敬请期待</h3>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button  type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> 微信支付</h4>
            </div>
            <div class="modal-body">
                <div class="row text-center pay-box">
                    <div class="col-md-6 col-xs-6 text-center"  id="qrcode">

                    </div>
                    <div class="col-md-6  col-xs-6">
                        <img width="100%" src="<?php echo Yii::$app->request->baseUrl.'/img/exp.png'?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>


<script>
    var count=0;
    var wait=1000;
    var trade_no='';
    $(function(){
        $('#buy').click(function(){  //点击购买
            var product_id='<?php echo $product_id;?>';
            $.post('<?php echo Url::to(['pay/payment'])?>?product_id='+product_id,function(data){
                trade_no=data.obj.trade_no;
                var url=data.obj.url;
                var html='<img  src="<?php echo Url::to(['pay/qrcode'])?>?url='+url+'" width="100%" />';
                html+='<img width="80%" src="<?php echo Yii::$app->request->baseUrl.'/img/shuo.png'?>">';
                $('#qrcode').html(html);
                showTime(trade_no);
            });
        });
    });
    function showTime(trade_no)
    {
        if(count>600){   //若10分钟未响应  拉长循环间隔时间
            wait=wait*10;
        }
        var circle='';
        $.post('<?php echo Url::to(['pay/query'])?>?out_trade_no='+trade_no,function(data){
            //  alert(data.obj.trade_state);
           // alert(data);
            if(data!=''&&data.obj.trade_state=="SUCCESS"){
                var html='<img width="50%" src="<?php echo Yii::$app->request->baseUrl.'/img/ok.png'?>"  style="margin-top:60px">';
                html+='<p>支付成功！</p>';
                $('#qrcode').html(html);
                var buy=$('#buy');
                var paper_id="<?php echo $paper_id;?>";
                var product_id='<?php echo $product_id;?>';
                buy.hide();
                var button='<a class="btn btn-primary" href="<?php echo Url::to(['result_back'])?>?paper_id='+paper_id+'&product_id='+product_id+'">点击查看</a>';
                buy.parent().append(button);

                clearTimeout(circle);    //停止循环
            }
        });
        var temp= $("#myModal").is(":hidden");//是否隐藏
        // alert(temp);
        if(temp==true) {  //如果扫码框影藏 或者已支付成功  则停止循环
            clearTimeout(circle);
            return false;
        }
        else  circle=setTimeout("showTime(trade_no)", wait);
    }
</script>
