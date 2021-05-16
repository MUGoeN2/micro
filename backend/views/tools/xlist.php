<style>
    .list-group-item{
        padding-top: 3px;
        padding-bottom: 3px;
    }
    .intro-table  td{
        padding:2px 5px;
        color: #c0c0c0;

    }
    .intro-piece{
        color: #000000;
        font-size: 12px;
    }
</style>
<div class="row text-center">
    <h3>有推广运营问题？给Memo提问，行业专家为您解答！<a class="btn btn-primary btn-sm" href="<?php echo \yii\helpers\Url::to(['grouth/product'])?>">测评一下</a></h3>
    <div class="col-md-4 col-md-offset-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
             <span class="input-group-btn">
             <button class="btn btn-primary" type="button">提问</button>
             </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-10 " style="background-color: #fff;border-radius: 10px">
                <h3 class="text-center" >工具导航</h3>
                <hr style="margin: 5px">
                <?php foreach($cate as $v){  ?>
                    <div class="row" style="margin-bottom: 15px">
                        <p class="text-center" style=""><button type="button" class="btn  btn-primary"><?php echo $v->name  ?></button></p>
                        <ul class="list-group" style="margin-bottom:0 ">
                            <?php $articles=\common\models\Article::find()->all();
                            foreach($articles as $m){
                                if($m->cate2==$v->id){ if($m->cate3!=2){?>
                                    <li class="list-group-item text-center" style="border:none" id="<?php echo $m->article_id?>"><?php echo $m->article_name ?></li>
                                <?php }else{
                                    echo "<li  class='list-group-item text-center' style='border:none'><a href='list?cate3=$m->cate3&cate2=$m->cate2&article_id=$m->article_id'>$m->article_name</a></li>";
                                } } }     ?>

                        </ul>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
    <div class="col-md-9" style="background-color: #fff;border-radius: 10px"  >
        <div class="row" style="background-color: #fff;border-radius: 10px;min-height: 400px" id="content">
            <div class="col-md-12" >
                <div class="row" style="padding:10px 5%">
                    <div class=" alert alert-success " style="background-color: #f6f6f6;">
                        <?php
                        if(isset($_GET['cate3'])) $cate3=$_GET['cate3'];
                        if(isset($_GET['cate2'])) $cate2=$_GET['cate2'];
                        if(isset($_GET['article_id'])) $article_id=$_GET['article_id'];
                       $arr=array('平台','标签一','标签一','标签一','标签一','标签一');
                        ?>
                        <ul class="list-inline">
                            <?php foreach($arr as $v){
                                echo "<li><a href='list?cate3=$cate3&cate2=$cate2&article_id=$article_id&label=$v'>$v</a></li>";
                            }?>
                        </ul>
                    </div>
                    <div class=" alert alert-success " style="background-color: #f6f6f6;">
                        共收录123条记录
                    </div>
                </div>
            </div>
             <div class="col-md-12" style="padding:10px 5%" >
             <?php   foreach($models as $v){  ?>
                 <div class="media">
                     <div class="media-left media-middle">
                         <a href="#">
                             <img class="media-object" src="<?php echo Yii::$app->request->baseUrl.$v->relationImg->img_small?>" alt="..." width="200px">
                         </a>
                     </div>
                     <div class="media-body" style="padding: 12px 5px 0 15px">
                         <h3 class="media-heading"><strong><?php echo $v->name ?></strong></h3>
                         <table style="width: 100%" class="intro-table">
                             <tr><td style="width: 50%"><span class="intro-piece">付费：</span><?php echo $v->piece1 ?></td><td style="width: 50%"><span class="intro-piece">付费：</span><?php echo $v->piece2 ?></td></tr>
                             <tr><td style="width: 50%"><span class="intro-piece">介绍1：</span><?php echo $v->piece3 ?></td><td style="width: 50%"><span class="intro-piece">介绍1：</span><?php echo $v->piece4 ?></td></tr>
                             <tr><td><span class="intro-piece">介绍1：</span><?php echo $v->piece5 ?></td></tr>
                             <tr><td><span class="intro-piece">介绍1：</span><?php echo $v->piece6 ?></td></tr>
                         </table>
                     </div>
                 </div>
             <?php  } ?>
             </div>
             <div class="col-md-12" style="padding:10px 5%">
                <?php    echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                ]);  ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('.list-group').find('.list-group-item').click(function(){
        //alert(1);
        var article_id=$(this).attr('id');
        $.post('get?article_id='+article_id,function(data){
            //  alert(data);
            $('#content').html('');
            $('#content').html(data);
        });
    });
</script>