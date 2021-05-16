
<script>
    $(function(){
        $('.carousel').carousel({
            interval: 3000
        })
    });
</script>
            <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
                    <!-- Indicators小圆圈 -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
<!--                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>-->
                    </ol>
                    <!-- Wrapper for slides 具体内容-->
                    <div class="carousel-inner" role="listbox" >
                        <div class="item active" style="overflow: hidden">
                            <img src='<?php  echo Yii::$app->request->baseUrl;?>/assets/images/lunbo/lunbo1.jpg' width="100%">
                            <div class="carousel-caption">
                                                                 </div>
                        </div>
                        <div class="item"  style="overflow: hidden">
                            <img src='<?php  echo Yii::$app->request->baseUrl;?>/assets/images/lunbo/lunbo2.gif' width="100%">
                            <div class="carousel-caption">
                            </div>
                        </div>
                        <div class="item" >

                            <img src='<?php  echo Yii::$app->request->baseUrl;?>/assets/images/lunbo/lunbo3.jpg' width="100%">

                            <div class="carousel-caption">
                            </div>
                        </div>
<!--                        <div class="item">-->
<!--                            <a href="--><?//= Url::to(['site/index']);?><!--">-->
<!--                                <img src='--><?php // echo Yii::$app->request->baseUrl;?><!--/assets/images/lunbo/case44.png' width="100%">-->
<!--                            </a>-->
<!--                                         <div class="carousel-caption">-->
<!--                                         </div>-->
<!--                             </div>-->
                    </div>

                    <!-- Controls 上一页，下一页-->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" >
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">上一页</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">下一页</span>
                    </a>
                </div>
        </div>

