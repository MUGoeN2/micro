<style>
    .carousel-indicators li,.carousel-indicators .active{
        width: 16px;
        height: 16px;
        margin: 0 5px;
    }

</style>
<script>
    $(function(){
        $('.carousel').carousel({
            interval: 3000
        })
    });
</script>
<?php
$models=\common\models\Banner::find()->where(['cate'=>1])->orderBy('weight desc')->limit(5)->all();
?>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
    <!-- Indicators小圆圈 -->
    <ol class="carousel-indicators" style="text-align: left;">
        <?php
        $count=count($models);
        for($i=0;$i<$count;$i++)
        { ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php if($i==0) echo 'class="active"'; ?>></li>
        <?php }
        ?>
    </ol>
    <!-- Wrapper for slides 具体内容-->
    <div class="carousel-inner" role="listbox" style="height: 410px;" >
        <?php
        $i=0;
        if(!empty($models)){
            foreach($models as $v){ ?>
                <div class="item <?php if($i==0){ ?>active <?php }?>" style="overflow: hidden;max-height: 600px;height: 100%">
                    <a href="#">
                        <img src='<?php  echo Yii::$app->request->baseUrl.$v->pic; ?>' width="100%" style="height: 100%">
                    </a>
                    <div class="carousel-caption">
                    </div>
                </div>
                <?php
                $i++;
            }
        }
        ?>
    </div>

    <!-- Controls 上一页，下一页-->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" style="background: none">
        <span style="position: absolute;top: 50%;z-index: 5;display: inline-block;"><img src="<?php echo Yii::$app->request->baseUrl.'/vanke/prev.png';?>"></span>
        <span class="sr-only">上一页</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" style="background: none">
        <span style="position: absolute;top: 50%;z-index: 5;display: inline-block;"><img src="<?php echo Yii::$app->request->baseUrl.'/vanke/next.png';?>"></span>
        <span class="sr-only">下一页</span>
    </a>
</div>

