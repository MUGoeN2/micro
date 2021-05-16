<?php
use common\models\CepingSubject;
use common\models\CepingLabel;
?>
<?php
$arr=array('#ffff33','#71cb45','#59ce99','#5acace','#ff9a00');
$uid=Yii::$app->user->id;
$result=\common\models\Shopcart::find()->where(['uid'=>$uid,'product_id'=>$product_id,'status'=>1])->one();
?>
<style>
    .title{
        font-size: 20px;padding: 0 10px
    }
    td{
        font-size: 20px;
    }
    .row{
        background-color: #fff;
        font-family: 微软雅黑;
    }
    a{
        color: #101010;
    }
    a:hover{
        text-decoration: none;
    }
</style>
<div class="row">
    <img src="<?php echo Yii::$app->request->baseUrl.'/img/report.png'?>" width="100%">
</div>

<div class="row"  style="background-color: #2ba3d5">
    <div class="col-md-8 col-md-offset-2 text-center" >
        <table class="table" style="margin-bottom: 0">
            <tr>
                <td style="background-color:<?php echo $arr[0];?>" >  <a href="<?php echo \yii\helpers\Url::to(['creport/result_back','paper_id'=>$paper_id,'product_id'=>$product_id]);?>">概述</a></td>
                <?php
                $i=1;
                $j=0;

                foreach($finalReport as $v){      //遍历得到的报告名  将其种类名列出来
                    //  p($a);die;
                    $url=\yii\helpers\Url::to(['creport/detail','paper_id'=>$paper_id,'level'=>$v->level,'name'=>$v->name,'product_id'=>$product_id]);
                    if($i==5) $i=0;
                    echo "<td style='background-color:$arr[$i]'><a href='$url'>".$v->name."</a></td>";
                    if($v->name==$_GET['name']) $j=$i;
                    $i++;
                }
                ?>
            </tr>
        </table>
    </div>
</div>

<div class="row" style="background-color: #fff">
    <div class="container">
        <div class="row">
            <img src="<?php echo Yii::$app->request->baseUrl.'/img/step.png'?>" width="100%">
        </div>
    </div>
</div>

            <div class="row" style="border-top: 2px solid <?php echo  $arr[$j];?>;min-height: 300px;padding-bottom: 30px">
        <div class="container">
            <div class="row">
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo  $arr[$j];?>"><?php echo $showReport->name; ?></label>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_1_title ? $showReport->content_1_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_1;?>
                    </p>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_2_title ? $showReport->content_2_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_2;?>
                    </p>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_3_title ? $showReport->content_3_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_3;?>
                    </p>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_4_title ? $showReport->content_4_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_4;?>
                    </p>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_5_title ? $showReport->content_5_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_5;?>
                    </p>
                </div>
                <div class="col-md-12  text-center">
                    <label class='title' style="width:150px;background-color:<?php echo $arr[$j]; ?>;"><?php echo $showReport->content_6_title ? $showReport->content_6_title : ""; ?></label>
                </div>
                <div class="col-md-12">
                    <p>
                        <?php echo $showReport->content_6;?>
                    </p>
                </div>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-md-12 text-center">
        <!--        <h2>测评结果报告（体验版）</h2>-->
        <h2><?php //echo $report->name ?></h2>
    </div>
</div>


