<?php
use \yii\helpers\Url;
?>
<script>
    $(document).on('click','.invite',function(){
        var that=$(this);
        var tel=$(this).attr('tel');
        var id=$(this).attr('data-id');
        $.post('allow?tel='+tel+'&id='+id,function(data){
        //alert(data);
            if(data=="yes") {
            that.parent().html("<button class='btn btn-default'>已发送</button>");
            }else alert("发送失败");
        });
    });
</script>
<div class="row">
    <div class="col-md-12">

        <table class="table">
            <tr><th>姓名</th><th>公司/组织-职位</th><th>时间</th><th>电话</th><th>地址</th><th>邀请码</th><th>操作</th></tr>
            <?php
            foreach ($models as $model) {
                echo "<tr><td>$model->name</td><td>$model->from - $model->position</td><td>".date('m-d h:i',$model->created_at)."</td><td>$model->tel</td><td>$model->city</td>";
                echo "<td>$model->res1</td><td>";
                if($model->status==0){
                    echo "<button class='btn btn-info invite' tel='$model->tel' data-id='$model->id'>发送邀请</button>";
                }else{
                    echo "<button class='btn btn-default'>已发送</button>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        // 显示分页
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-3">
    <a href="<?php echo  Url::to(['sended'])?>" class="btn btn-info">
         已发送用户
    </a>
    </div>
    <div class="col-md-3">
        <a href="<?php echo  Url::to(['ready'])?>" class="btn btn-info">
            未发送用户
        </a>
    </div>
</div>