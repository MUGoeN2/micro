<style>
    .list-group-item{
        padding-top: 3px;
        padding-bottom: 3px;
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
            <div class="col-md-10 col-md-offset-1" style="background-color: #fff;border-radius: 10px;min-height: 400px">
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
                <hr style="margin: 5px">
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 " style="background-color: #fff;border-radius: 10px;min-height: 400px">
                <div class="row" style="padding:10px 5%;" id="content">
                    文章内容
                </div>
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