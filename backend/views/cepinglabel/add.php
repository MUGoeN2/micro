
<?php
use \yii\bootstrap\ActiveForm;

use \yii\helpers\Url;

$this->title = '新题录入 ';
$this->params['breadcrumbs'][] = ['label' => '管理中心', 'url' => ['admin']];
$this->params['breadcrumbs'][] = '新题录入';

$form =ActiveForm::begin(); ?>
<form action="<?php echo \yii\helpers\Url::to(['cepinglabel/add'])?>" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info text-center"><h4>录入题库</h4></div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="control-label" for="label-cate">题型分类</label>
                    <select id="label-cate" class="form-control"  name="cate">
                        <?php $model=\common\models\LabelCate::find()->all();
                        foreach($model as $v){ ?>
                            <option value="<?php echo $v->cate?>"><?php echo $v->name?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group ">
                        <label class="control-label" for="cepingreport-name">题干</label>
                        <input type="text" id="cepingreport-name" class="form-control" name="main" placeholder="输入题干内容" >
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>

            <div class="row" id="answer-list">
                <div class="col-md-8">
                    <div class="form-group ">
                        <label class="control-label" for="cepingreport-name">选项</label>
                        <input type="text" id="cepingreport-name" class="form-control"  value="" maxlength="20">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-md-4"  style="margin-top: 25px">
                    <button class="btn btn-primary add-exp" type="button" >添加</button>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <div class="row hidden">
    <div class="col-md-6 col-xs-6 col-md-offset-3 col-xs-offset-3">
        <input type="text" id="answer" class="form-control"  name="answer" value="" maxlength="400" placeholder="公司名称 您的职位">
    </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-success btn-lg" type="submit" name="sub">录入</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</form>
<script>
    var i=0;

    $(function() {
        $(".add-exp").click(function () {
            if (i > 15) {
                alert("最多添加5条");
                return false;
            }
            anserId=i+1;
            var input = '<div><div class="col-md-8" style="margin-top: 20px">' +
                '<input type="text"  class="form-control" onchange="add(this)" value="" maxlength="400">' +
                '</div>';

            //  alert(html);
            var button = '<div class="col-md-3" style="margin-top: 20px"><button type="button" class="btn btn-danger" onclick="reduce(this)">-</button></div></div>';
            $(this).parent().parent().append(input+button);
            i++;
        });
    });
    function add(th){

        var input_exp='';
        $('#answer-list').find('input').each(function(){
            input_exp+=$(this).val()+'@';
        });
//         var input_a=th.value;
     //   alert(input_exp);
        var exp=$('#answer');
        exp.attr('value',input_exp);
    }
    function reduce(th){
        i--;
        th.parentNode.parentNode.remove();
        var input_exp='';
        $('#answer-list').find('input').each(function(){
            input_exp+=$(this).val();
        });
//         var input_a=th.value;
        var exp=$('#answer');
        exp.attr('value',input_exp);
    }
</script>