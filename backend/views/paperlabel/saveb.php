<?php
use \yii\helpers\Url;
?>
<style>

</style>
<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">试题排序</div>
        <table class="table table-bordered">
            <?php foreach($model as $v){?>

            <?php if(empty($v->parent_id)){ ?>
        </table>
        <table class="table table-bordered">
            <tr><th style="width: 90%"><?php echo $v->label_id.'、'. $v->label_name; ?> </th><th>序号<input class="form-control" name="1"></th></tr>
            <?php }else{?>
                <tr><td><?php echo  $v->label_id.'、'.$v->label_name;?></td><td></td></tr>

            <?php    }  } ?>
        </table>

    </div>

</div>

