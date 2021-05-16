
<div class="row">
    <hr style="margin: 10px;border: none"/>
    <div class="col-md-12" style="margin-bottom: 20px">
        <h4><strong>我们提供以下不同版本供您选择:</strong></h4>
    </div>
    <div class="col-md-4" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">体验版</a>
            <ul class="list-group">
                <li class="list-group-item" style="border: none">条目：这是什么鬼</li>
                <li class="list-group-item" style="border: none">Dapibus ac facilisis in</li>
                <li class="list-group-item" style="border: none">Morbi leo risus</li>
                <li class="list-group-item" style="border: none">Porta ac consectetur ac</li>
                <li class="list-group-item" style="border: none">Vestibulum at eros</li>
            </ul>
            <h3 class="text-center alert alert-default" style="background-color: #e4e4e4">免费</h3>
        </div>
    </div>
    <div class="col-md-4" style="padding:0 40px">
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
                    <li class="" style="border: none;"><a class="btn" style="font-size: 25px;color: #000000">99元</a> <button class="btn btn-primary">购买</button></li>
                    <li class="" style="border: none"></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4" style="padding:0 40px">
        <div style="border: 1px solid #f6f6f6">
            <a class="btn btn-primary btn-block" href="#" role="button" style="font-size: x-large">**版</a>
            <ul class="list-group">
                <li class="list-group-item" style="border: none">条目：这是什么鬼</li>
                <li class="list-group-item" style="border: none">Dapibus ac facilisis in</li>
                <li class="list-group-item" style="border: none">Morbi leo risus</li>
                <li class="list-group-item" style="border: none">Porta ac consectetur ac</li>
                <li class="list-group-item" style="border: none">Vestibulum at eros</li>
            </ul>
            <h3 class="text-center alert alert-default" style="background-color: #e4e4e4">敬请期待</h3>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <?php $paperId=\common\models\CepingPaper::find()->where(['status'=>1])->one()->paperId; ?>
        <p><a class="btn btn-primary btn-lg " href="<?php echo \yii\helpers\Url::to(['csubject/test','paperId'=>$paperId])?>" role="button">开始测评</a></p>
    </div>
</div>














<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2015/10/19
 * Time: 16:41
 */