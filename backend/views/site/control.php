<script>
    $(function(){
        $('.open').click(function(){
            $.post('open',function(data){
                if(data=='yes')
                    location.reload()
            });
        });
        $('.close-open').click(function(){
            $.post('close',function(data){
                if(data=='yes')
                    location.reload()
            });
        });
    })
</script>


<div class="row">
    <div class="col-md-12">
        <table class="table">
            <tr><th>名字</th><th>配置</th></tr>
            <tr><td>是否开放管理员注册</td><td>
                    <?php $open=\common\models\Open::find()->one();
                    if($open->switch==0)
                        echo  '<button class="btn btn-success open">开启（已关闭）</button>';
                    else
                        echo  '<button class="btn btn-primary close-open">关闭（已开启）</button>';
                    ?>
                </td>
            </tr>
            <tr><td>php版本</td><td><?php echo phpversion();?></td></tr>
            <tr><td>yii版本</td><td> <?php echo Yii::getVersion(); ?></td></tr>
            <tr><td>服务器IP</td><td><?php echo $_SERVER["HTTP_HOST"] ;?></td></tr>
            <tr><td>域名</td><td><?php echo $_SERVER['SERVER_NAME'] ;?></td></tr>
        </table>
    </div>
</div>