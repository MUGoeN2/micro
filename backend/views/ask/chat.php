<?php

?>

<script>
    $(function(){
        $(document).on('click','.answer',function(){
            var an=$('.answer-box');
            if(an.length>0){
                an.parent().parent().remove();
            }
            var parent_id=$(this).attr('parent_id');
            var to=$(this).attr('to');
            var place=$(this).closest('.col-md-12');
            // alert(parent_id);
            var input="<div class='row'><div class='col-md-12'><textarea class='form-control answer-box' parent_id='"+parent_id+"' to='"+to+"'></textarea></div>";
            var sure ="<div class='col-md-12 text-right sure-box' style='padding-top: 5px'><button class='btn btn-default sure'>确认回复</button></div></div>";
            place.after(input+sure);
        });
        $(document).on('click','.sure',function(){
            var answer_box=$('.answer-box');
            var content=answer_box.val();
            if(content==''){ alert('请输入内容');return false}
            var parent_id=answer_box.attr('parent_id');
            var to=answer_box.attr('to');
            var place=$(this).closest('.list');
            $.post('reply?content='+content+'&parent_id='+parent_id+'&to='+to,function(data){
                if(data!="no"){
                    var d=data.obj;
                    //   alert(d.userId);
                    var html='';
                    html+='<div class="col-md-12  well" style="padding-left: 5%"> ' +
                        '<div class="media">' +
                        ' <div class="media-left">' +
                        ' <a href="#">' +
                        ' <img class="media-object" src="'+d.res1+'" width="50px">' +
                        '</a>' +
                        '</div>' +
                        '<div class="media-body">' +
                        '<p class="media-heading">'+ d.username+'&#12288;'+
                        '<small>'+d.created_at+'</small>';
                    var uid='admin<?php echo Yii::$app->user->id; ?>';
                    if(d.userId!=uid) {
                        html += '<small class="pull-right answer" parent_id="' + d.parent_id + '" to="' + d.id + '">回答</small>';
                    }
                    html+= '</p> <p><small style="color:#23527c">@'+d.res2+'</small>&#12288;'+d.content+'</p></div> </div> </div>';

                    place.append(html);
                    $('.answer-box').parent().remove();
                    $('.sure-box').remove();
                }
                else{ alert(data);}
            });
        });
        $('.open').click(function(){
            if($(this).text()=="展开")
                $(this).text('收起');
            else $(this).text('展开');

            var show= 'parent'+$(this).attr('data');
            //  alert(show);
            $("."+show).toggle();
        });
    });
</script>
<style>
    .well{
        margin: 5px;
        padding: 5px 20px 5px 5px;
    }
    .row{
        padding:0 15px;
    }
</style>
    <?php
    foreach ($models as $model) {
        $image='/img/demo.png';
        if(isset($model->relationImg->img_small)) $image=$model->relationImg->img_small;
        $replies=\common\models\Chat::find()->where(['parent_id'=>$model->id])->all();
        $count=count($replies);
        ?>
        <div class="row list">
            <div class="col-md-12 well">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="<?php echo Yii::$app->request->baseUrl.$image;?>" width="50px">
                        </a>
                    </div>
                    <div class="media-body">
                        <p class="media-heading"> <?php echo $model->username;?>&#12288;
                            <small><?php echo date('Y-m-d h:i',$model->created_at); ?></small>
                            <small class="pull-right answer" parent_id="<?php echo $model->id; ?>" to="<?php echo $model->id; ?>">回答</small>
                        </p>
                        <p><?php echo  $model->content ; ?><small  class="pull-right"><?php echo "(".$count.")"; ?></small><small class="pull-right open" data="<?php echo $model->id;?>">展开</small></p>
                    </div>
                </div>
            </div>

            <?php
            foreach($replies as $v){
                $image='/img/demo.png';
                if(isset($model->relationImg->img_small)) $image=$model->relationImg->img_small; ?>
                <div class="col-md-12  well parent<?php echo $model->id;?>" style="display: none;padding-left: 5%">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="<?php echo Yii::$app->request->baseUrl.$image;?>" width="50px">
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="media-heading">
                                <?php echo $v->username;if($v->weight>0) echo "<span class='glyphicon glyphicon-ok-sign'></span>"?>&#12288;<small><?php echo date('Y-m-d h:i',$v->created_at); ?></small>
                                <?php $uid=Yii::$app->user->id;if($v->userId!="admin$uid"){ ?> <small class="pull-right answer" parent_id="<?php echo $v->parent_id; ?>" to="<?php echo $v->id; ?>">回答</small><?php } ?>
                            </p>
                            <p><small style="color:#23527c">@<?php echo  \common\models\Chat::findOne(['id'=>$v->to])->username; ?> </small>&#12288;<?php echo  $v->content; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>



    <?php
    // 显示分页
    echo \yii\widgets\LinkPager::widget([
        'pagination' => $pages,
    ]);

    ?>

