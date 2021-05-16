<?php
$arr=array('ffff33','71cb45','59ce99','5acace','ff9a00');
?>

<style>
    .title{
        font-size: 20px;padding: 0 10px
    }
    .table tr td{
        font-size: 20px;
        padding: 0 10px;
    }
</style>
<div class="row" >
    <div class="col-md-12">
        <img src="<?php echo Yii::$app->request->baseUrl.'/img/report.png'?>" width="100%">
    </div>
</div>

<div class="row"  style="background-color: #2ba3d5">
    <div class="col-md-8 col-md-offset-2 text-center" >
        <table class="table" >
            <tr><td style="background-color: #ffff33;">概述</td><td></td></tr>
        </table>
    </div>
</div>


<div class="row">
    <div class="col-md-12  text-center" style="border-top: 2px solid #ffff33">
        <label class='title' style="background-color: #ffff33;">1、EDM概述</label>
    </div>
    <div class="col-md-12" >
        <p>文章内容</p>
    </div>
</div>
<div class="row" >
    <div class="col-md-12  text-center" style="border-top: 2px solid #71cb45">
        <label  class='title'  style="background-color: #71cb45">2、渠道选择</label>
    </div>
    <div class="col-md-12" >
        <p>文章内容</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12  text-center" style="border-top: 2px solid #59ce99">
        <label  class='title' style="background-color: #59ce99">3、邮件列表</label>
    </div>
    <div class="col-md-12" >
        <p>文章内容</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12  text-center" style="border-top: 2px solid #5acace">
        <label  class='title' style="background-color: #5acace">4、邮件列表</label>
    </div>
    <div class="col-md-12" >
        <p>文章内容</p>
    </div>
</div>

<div class="row">
    <div class="col-md-12  text-center" style="border-top: 2px solid #ff9a00">
        <label  class='title' style="background-color: #ff9a00">5、邮件列表</label>
    </div>
    <div class="col-md-12" >
        <p>文章内容</p>
    </div>
</div>