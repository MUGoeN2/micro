<?php
use xj\qrcode\QRcode;
use xj\qrcode\widgets\Text;
use \yii\helpers\Url;
?>

<div class="row text-center">
    <div class="col-md-12" style="width: 300px;height: 300px;top:50%;left:50%;position:absolute;margin-top: -150px;margin-left: -150px;padding: 15px;background-color: #fff">
        <?php
        //Widget通过Action生成QR
        $key=rand(1000,9999).date('mdh').rand(1000,9999);
        echo Text::widget([
            'text' => \Yii::$app->params['domain'].Url::to(['manage/login','key'=>$key]),
            'size' => 4,
            'margin' => 4,
            'ecLevel' => QRcode::QR_ECLEVEL_L,

        ]);
        ?>
        <h4 class="sao-tip" style="margin-top: 15px">微信扫码登录</h4>
    </div>
</div>

<script>

    $(document).ready(function(){
        longPolling();
    });
    function longPolling() {
        $.ajax({
            url: "check_key",
            data: {"key": <?php echo $key?> },
            dataType: "text",
            timeout: 300000,//5分钟超时，可自定义设置
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("[state: " + textStatus + ", error: " + errorThrown + " ]<br/>");
                if (textStatus == "timeout") { // 请求超时
                  return false; // 递归调用
                } else { // 其他错误，如网络错误等
                    longPolling();
                }
            },
            success: function (data, textStatus) {
           //     console.log("[state: " + textStatus + ", data: { " + data + "} ]<br/>");
                if (textStatus == "success") { // 请求成功
                    if(data=="yes")
                    {
                        console.log("已登录，跳转页面");
                        window.location="<?php echo Url::to(['manage/index'])?>";
                    }
                    if(data=="refresh")  console.log("二维码失效，请刷新页面");
                }
            }
        });

    }
</script>