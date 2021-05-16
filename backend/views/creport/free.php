<?php
use common\models\CepingSubject;
use common\models\CepingLabel;
use yii\helpers\Url;
?>
<?php
$arr=array('#ffff33','#71cb45','#59ce99','#5acace','#ff9a00');
?>
<style>
    .title{
        font-size: 20px;padding: 0 10px
    }
    td{
        font-size: 20px;
    }
    .row{
        background-color: #fff;
        font-family: 微软雅黑;
    }
    a{
        color: #101010;
    }
    a:hover{
        text-decoration: none;
    }
</style>
<div class="row">
    <img src="<?php echo Yii::$app->request->baseUrl.'/img/report.png'?>" width="100%">
</div>

<div class="row"  style="background-color: #2ba3d5">
    <div class="col-md-8 col-md-offset-2 text-center" >
        <table class="table" style="margin-bottom: 0">
            <tr>
                <td style="background-color:<?php echo $arr[0];?>" >  <a href="<?php echo \yii\helpers\Url::to(['creport/result_back','paper_id'=>$paper_id,'product_id'=>$product_id]);?>">概述</a></td>
                <?php
                $i=1;
                $menu=array();
                foreach($finalReport as $v){      //遍历得到的报告名
                        //  p($a);die;
                        $item=$v->level;
                        $url=\yii\helpers\Url::to(['creport/detail','paper_id'=>$paper_id,'level'=>$item,'name'=>$v->name,'product_id'=>$product_id]);
                        if(!in_array($item,$menu)){
                            if($i==5) $i=0;
                                echo "<td style='background-color:$arr[$i]; '><a href='#ask-pay'>$item</a></td>";  //大类标题以及链接
                            $i++;
                            $menu[]=$item;
                        }
                }
                ?>
            </tr>
        </table>
    </div>
</div>

<div class="row" style="background-color: #fff">
    <div class="container">
        <div class="row">
            <img src="<?php echo Yii::$app->request->baseUrl.'/img/step.png'?>" width="100%">
        </div>
    </div>
</div>


<?php
$i=1;
$menu=array();
foreach($finalReport as $v){
    $item=$v->level;
    if(!in_array($item,$menu)){
    if($i==5) $i=0;
    ?>
    <div class="row" style="border-top: 2px solid <?php echo $arr[$i] ?>;min-height: 300px;padding-bottom: 30px">
        <div class="container">
            <div class="row">
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$i]; ?>;"><?php echo $item; ?></label>
                </div>
                <div class="col-md-12">
                    <h4>&#12288; &#12288;<?php echo $v->name;?></h4>
                     <p>
                    <?php echo$v->content;?>
                     </p>
                </div>
                <div class="col-md-12 text-center">
                        <a href="#ask-pay"><label style="padding:2px 15px;font-size:15px;background-color:<?php echo $arr[$i]; ?>;">点击 了解详细结果</label></a>
                </div>
            </div>
        </div>
    </div>
    <?php  $i++; $menu[]=$item; }
        break;  //如果没有付费则 只显示一小部分
} ?>
<?php    //如果没有付费则 显示可支付界面?>
<div class="row"  style="padding:10px 60px" id="ask-pay">
    <div class="col-md-12">
        <h4><strong>更多内容:</strong></h4>
    </div>
    <div class="col-md-6 col-md-offset-3" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">专业版</a>
            <ul class="list-group">
                <li class="list-group-item" style="border: none">条目：这是什么鬼</li>
                <li class="list-group-item" style="border: none">Dapibus ac facilisis in</li>
                <li class="list-group-item" style="border: none">Morbi leo risus</li>
                <li class="list-group-item" style="border: none">Porta ac consectetur ac</li>
                <li class="list-group-item" style="border: none">Vestibulum at eros</li>
            </ul>
            <div class=" text-center alert alert-default" style="background-color: #e4e4e4">
                <ul class="list-inline">
                    <li class=" btn text-left" style="border: none"><strong>限时价：</strong><br>原价：699元</li>
                    <li class="" style="border: none;"><a class="btn" style="font-size: 25px;color: #000000">299元</a>
                        <?php $uid=Yii::$app->user->id;   //查询是否付费 如果已付费则可查看
                        $result=\common\models\Shopcart::find()->where(['uid'=>$uid,'product_id'=>$product_id,'status'=>1])->one();
                        if(!empty($result)){
                            echo "<a class='btn btn-primary' href='result_back?paper_id=$paper_id&product_id=$product_id'>点击查看</a>";
                        }else{  ?>
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