<?php use yii\helpers\Url;?>
<div class="row" >
    <hr style="margin:30px 0;border: none"/>
    <div class="col-md-8 col-md-offset-2" style="border-radius:8px;padding:30px 40px;background-color: #fff">
        <div class="progress" style="height:10px">
            <div id="progress" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" >
                <span class="sr-only" >60% Complete</span>
            </div>
        </div>
        <hr style="margin:10px 0;border: none"/>
        <div class=" row" style="padding: 0 50px">
            <div class="col-md-12">
                <h4 id="subject-question"><strong class="question_num">1</strong>、<?php echo $question->rank ?>.<?php echo $question->label_name ?></h4>
                <ul class="list list-group " id="subject-answers">

                    <?php
                    $arr=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q');
                    $i=0;
                    foreach($answers as $an){ ?>
                        <li class="li-answer list-group-item">
                            <span><?php echo $arr[$i];?>、&#12288;<?php echo $an->label_name ?></span>
                            <input type="hidden" name="id" value="<?php echo $an->label_id ?>">
                        </li>
                        <?php  $i++;  }?>
                </ul>
            </div>
        </div>
        <hr style="margin:30px 0;border: none"/>
        <div class=" row text-center alert" style="background-color: #6cabc9">
            <div class="col-md-2 col-xs-6">
                <button class="btn btn-primary disabled hidden" id="previous-subject">上一题</button>
            </div>
            <div class="col-md-2 col-md-offset-8 col-xs-6">
                <button class="btn btn-primary" id="next-subject">下一题</button>
            </div>
            <input type="hidden" id="previousSubjectId" value="">
            <input type="hidden" id="subjectId" value="<?php echo $question->rank ?>">
            <input type="hidden" id="answerId" value="">
        </div>
    </div>
</div>

<script>


    $(function () {
        var question_num=1;
        var paperId=<?php echo $paperId?>;
        var arr=new Array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q');

        $(document).on('click', '.li-answer', function() {
            $('#answerId').val($(this).find('input[name="id"]').val());
            $(this).attr('class','li-answer list-group-item list-group-item-info');
            $(this).siblings().attr('class','li-answer list-group-item ');
        });
        $('#previous-subject').click(function () {
            if($(this).hasClass("disabled")) return false;
            <?php $url=Url::to(['csubject/previous']);?>
            $.post('<?php echo $url?>?&paperId='+paperId, function(data) {
                $('#subjectId').val(data.question.rank);
                $('#subject-question').html('<strong class="question_num"></strong>、'+data.question.rank + "." + data.question.label_name);
                var html = "";
                var i=0;
                $.each(data.answers, function(index, obj) {
                    html += "<li class='li-answer list-group-item'><span>"+arr[i]+"、&#12288;" + obj.label_name + "</span><input type='hidden' name='id' value='" + obj.label_id + "'></li>";
                    i++;
                });
                $('#subject-answers').html(html);
                if(data.question.rank==1)  $('#previous-subject').addClass('disabled');
                addProcess(data.question.rank);
                question_num--;
                $('.question_num').text(question_num);
                $('#next-subject').text("下一题");
            });
        });

        $('#next-subject').click(function () {
            var subjectId = $('#subjectId').val();
            var answerId = $('#answerId').val();
            if(answerId == "") {
                alert("请选择答案");
                return ;
            }

            if($(this).text() == "下一题") {
                <?php $url=Url::to(['csubject/next']);?>
                $.post('<?php echo $url?>?subjectId=' + subjectId + '&answerId=' + answerId+'&paperId='+paperId, function(data) {
                    $('#answerId').val("");
                    $('#subjectId').val(data.next.rank);
                    $('#subject-question').html('<strong class="question_num"></strong>、'+data.next.rank + "." + data.next.label_name);
                    var html = "";
                    var i=0;
                    $.each(data.nextAnswer, function(index, obj) {
                        html += "<li class='li-answer list-group-item'><span>"+arr[i]+"、&#12288;" + obj.label_name + "</span><input type='hidden' name='id' value='" + obj.label_id + "'></li>";
                        i++;
                    });
                    $('#subject-answers').html(html);
                    $('#previous-subject').removeClass('disabled');
                    addProcess(data.next.rank);
                    question_num++;
                    $('.question_num').text(question_num);
                    if(data.end) {
                        $('#next-subject').text("提交");
                    }
                });
            } else if($(this).text() == "提交") {
                var url_to = "<?php echo Url::to(['csubject/result']) ?>?subjectId=" + subjectId + "&answerId=" + answerId + "&paperId=" + paperId;
                window.location = url_to;
            }
        });
    });
    function addProcess(rank) {
        var count=<?php echo $count?>;
        var piece=((rank-1)/count)*100;
        var percent='width:'+piece+'%';
        $('#progress').attr('style',percent);
    }
</script>