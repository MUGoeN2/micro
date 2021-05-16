
<br>
<br>
<br>

<div class="row">
    <div class="col-md-6">
        <!--        <div class="row">-->
        <!--            <div class="col-md-10 col-md-offset-1 text-center" style="background-color: #fff;border-radius: 10px">-->
        <!--                <h3>智库导航</h3>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        --><?php //foreach($model1 as $v){  if($v->name=="智库导航") {    //遍历二级类 显示智库导航类容 ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px;padding-bottom: 30px">
                <h3 class="text-center" >智库导航</h3>
                <?php foreach($model_a as $m) { ?>
                    <div class="row col-md-12">
                    <hr>
                    <button class="btn btn-primary" type="button"><?php echo $m->name?></button>
                    <hr>
                    <ul class="list-inline">
                        <?php
                        $articles=\common\models\Article::find()->where(['cate1'=>1,'cate2'=>$m->id])->all();
                        foreach($articles as $n) {      // 显示文章列表  如果文章名为平台类名字

                                echo "<li><a href='list?cate3=$n->cate3&cate2=$n->cate2&article_id=$n->article_id'>$n->article_name</a></li>";
                        }?>
                    </ul>

                    </div><?php     }  ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <!--        <div class="row">-->
        <!--            <div class="col-md-10 col-md-offset-1 text-center" style="background-color: #fff;border-radius: 10px">-->
        <!--                <h3>智库导航</h3>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        --><?php //foreach($model1 as $v){  if($v->name=="智库导航") {    //遍历二级类 显示智库导航类容 ?>
        <div class="row">
            <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px;padding-bottom: 30px">
                <h3 class="text-center" >智库工具</h3>
                <?php foreach($model_b as $m) {    ?>
                    <div class="row col-md-12">
                    <hr>
                    <button class="btn btn-primary" type="button"><?php echo $m->name?></button>
                    <hr>
                    <ul class="list-inline">
                        <?php
                        $articles=\common\models\Article::find()->where(['cate1'=>2,'cate2'=>$m->id])->all();
                        foreach($articles as $n) {      // 显示文章列表  如果文章名为平台类名字
                            echo "<li><a href='list?cate3=$n->cate3&cate2=$n->cate2&article_id=$n->article_id'>$n->article_name</a></li>";
                        }?>
                    </ul>

                    </div><?php     }  ?>
            </div>
        </div>
    </div>
</div>







<!--<div class="col-md-6">-->
<!---->
<!--    <div class="row">-->
<!--        <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px">-->
<!--            <h3 class="text-center" >工具导航</h3>-->
<!--            <hr>-->
<!--            <button class="btn btn-primary" type="button">公司黄页</button>-->
<!--            <hr>-->
<!--            <ul class="list-inline" style="">-->
<!--                <li>广告平台</li>-->
<!--                <li>应用市场</li>-->
<!--                <li>营销服务</li>-->
<!--            </ul>-->
<!--            <hr>-->
<!--        </div>-->
<!--        <div class="col-md-1"> &#12288;</div>-->
<!--    </div>-->
<!--    <div class="row">-->
<!--        <div class="col-md-10 col-md-offset-1" style="background-color: #fff">-->
<!--            <button class="btn btn-primary" type="button">公司黄页</button>-->
<!--            <hr>-->
<!--            <ul class="list-inline" style="">-->
<!--                <li>广告平台</li>-->
<!--                <li>应用市场</li>-->
<!--                <li>营销服务</li>-->
<!--            </ul>-->
<!--            <hr>-->
<!--        </div>-->
<!--        <div class="col-md-1"> &#12288;</div>-->
<!--    </div>-->
<!---->
<!--</div>-->