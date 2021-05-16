/**
 * Created by lenovo on 2016/2/14.
 */
$(function(){
    //$(document).on('ready',function(){
    //    var url='../operate/check-mess';
    //    $.post(url,function(data){
    //        if(data!='no'){
    //            $('.mess-tip').removeClass('hidden');
    //        }else{
    //            $('.mess-tip').addClass('hidden');
    //        }
    //        console.log(data);
    //    });
    //});
//调整详细图片大小
//    $(document).on('ready',function(){
//        $('.pictures img').each(function(){
//            var self_width=$(this).width();
//            var parent_width=$(this).parent().width();
//            if(self_width>parent_width){ //如果宽度大于最宽 则变为100%
//                $(this).attr('width','100%');
//            }
//        });
//    });
    //置换图片
    //$('.pic-detail-item').click(function(){
    //    var src=$(this).find('img').attr('src');
    //    $('.pic-main-box').find('img').attr('src',src);
    //});
    //$(document).on('click','.tag',function(){
    //    var tag=$(this).text();
    //    location.href ='tag?tag='+tag;
    //});
    //点赞
    $('.zan').click(function(){
        $('.icon-zan1').addClass('font-yellow');
        $('.zan-text').text('已点赞');
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var zan_num= parseInt($('.zan-num').text())+1;
        //alert(zan_num);
        var url='../operate/zan?type='+type+'&src_id='+src_id;
        $.post(url,function(data){
            if(data=='yes') {
                $('.zan-num').html('');
                $('.zan-num').html(zan_num);
                tip('点赞成功！');
            }else{
                tip('已赞！');
            }
            console.log(data);
        });
    });

    //收藏
    $('.collect').click(function(){
        var that=$(this);
        var src_id= $(this).attr('data-src_id');
        var type= $(this).attr('data-type');
        // alert(zan_num);
        var url='../operate/collect?type='+type+'&src_id='+src_id;
        $.post(url,function(data){
            that.text('已收藏');
            tip('收藏成功！');
            console.log(data);
        });
    });
    //报名
    $('.apply').click(function(){
        var src_id= $(this).attr('data-src_id');
        var type= $(this).attr('data-type');
        var url='../operate/apply?type='+type+'&src_id='+src_id;
        $.post(url,function(data){
            if(data=='yes') {
                $('.apply-text').text('报名成功');
                tip('报名成功！')
            }else {
                $('.apply-text').text('已经报名');
                tip('已经报名！')
            }
            console.log(data);
        });
    });
    //关注
    $('.follow').click(function(){
        var that=$(this).closest('.follow-text');
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var url='../operate/focus?type='+type+'&src_id='+src_id;
        $.post(url,function(data){
            if(data=='yes') {
                if(that.parent().hasClass('nav')){
                    that.html('<a href="#">已关注</a>');
                }else that.html('已关注');
            }else if(data=="no"){
                if(that.parent().hasClass('nav')){
                    that.html('<a href="#">已关注</a>');
                }else that.html('已关注');
            }else{
                console.log(data);
            }
        });
    });
    //评论
    $(document).on('click','.reply',function(){
        $(this).parent().next().toggle();
    });
    $(document).on('click','.reply-sure',function(){
        var that=$(this);
        var status=that.attr('status');
        if(status==undefined||status==null) status=1; //第一次点击给状态可传值
        that.attr('status',0);//快速点击失效
        var tip=$('#operate-tip');
        var content= $(this).parent().prev().val();
        var reply_id= $(this).parent().prev().attr('data-reply_id');
        var reply_uid= $(this).parent().prev().attr('data-reply_uid');
        var src_id= $(this).parent().prev().attr('data-src_id');
        var type  = $(this).parent().prev().attr('data-type');
        var url='../operate/comment?type='+type+'&src_id='+src_id+'&content='+content+'&reply_id='+reply_id+'&reply_uid='+reply_uid;
        if(status==1) { //第一次点击给状态可传值
            $.post(url,function(data){
                if(data=='yes') {
                    tip.find('.result-tip').text('评论成功！');
                    tip.find('.operate-sure').hide();
                    tip.modal('show');
                    setTimeout(function(){
                        tip.modal('hide');
                        that.removeAttr('disable');
                        that.attr('status',null);
                    },2000);
                    console.log(data);
                }
            });
        }
    });
    $(document).on('click','.close-tip',function(){
        $(this).parent().remove();
    });
    //标记已读信息
    $('.read-mess').click(function(){
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var op_uid=$(this).attr('data-uid');
        var url='../operate/read-mess?type='+type+'&src_id='+src_id+'&op_uid='+op_uid;
        $.post(url,function(data){
            console.log(data);
        });
    });
    //删除信息 //删除个人中心评论、点赞、私信消息操作
    $('.delete').click(function(){
        var tip=$('#operate-tip');
        tip.find('.result-tip').text('确认要删除吗？');
        tip.modal('show');
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var op_uid=$(this).attr('data-uid');
        var url='../operate/delete?type='+type+'&src_id='+src_id+'&op_uid='+op_uid;
        $('.operate-sure').click(function() {
            $.post(url,function(data){
                tip.find('.result-tip').text('操作成功！');
                console.log(data);
            });
        });
    });
    //删除收藏  取消报名 取消关注 取消收藏 取消团购/预约
    $('.quit').click(function(){
        var that=$(this).closest('.quit-text');
        var tip=$('#operate-tip');
        tip.find('.result-tip').text('确认要取消吗？');
        tip.modal('show');
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var op_type=$(this).attr('data-op_type');
        var url='../operate/quit?type='+type+'&src_id='+src_id+'&op_type='+op_type;
        $('.operate-sure').click(function() {
            $.post(url, function (data) {
                if (data == 'yes')
                {
                    that.text('已取消');
                    tip.find('.result-tip').text('操作成功！');
                }
                console.log(data);
            });
        });
    });
    //删除数据
    $('.del').click(function(){
        var that=$(this).closest('.del-text');
        var tip=$('#operate-tip');
        tip.find('.result-tip').text('确认要删除吗？');
        tip.modal('show');
        var src_id=$(this).attr('data-src_id');
        var type=$(this).attr('data-type');
        var url='../operate/del?type='+type+'&src_id='+src_id;
        $('.operate-sure').click(function(){
            $.post(url,function(data){
                if(data=='yes'){
                    tip.find('.result-tip').text('操作成功！');
                    that.text('操作成功');
                }
                console.log(data);
            });
        });
    });
    //私信
    $('#send').click(function(){
        $(this).toggle();
        var reply_uid=$(this).attr('data-reply_uid');
        var reply_username=$(this).attr('data-reply_username');
        var content=$('.modal-content');
        var input= $('#message-text').val();
        var url='../operate/send-mess?&content='+input+'&reply_username='+reply_username+'&reply_uid='+reply_uid;
        $.post(url,function(data){
            if(data=='yes') {
                content.find('form').hide();
                content.find('.send-tip').html('发送成功!');
            }else{
                $('#send').toggle();
            }
            console.log(data);
        });
        setTimeout(function(){
            $('#send-mess').modal('hide');//隐藏模态框
            $('#message-text').val(null);//清空发送内容
            content.find('.send-tip').html('');//清空发送提示
            content.find('form').show();//显示表单
            $('#send').toggle();//显示发送按钮
        },2000);
    });
    $('.pull-up').click(function(){ //置顶评论
        var  that=$(this).closest('.pull-up-text');
        var  src_id=$(this).attr('data-src_id');
        var  type=$(this).attr('data-type');
        var  comment_id=$(this).attr('data-comment_id');
        var  url='../operate/pull?type='+type+'&src_id='+src_id+'&comment_id='+comment_id;
        var  tip=$('#operate-tip');
        tip.find('.result-tip').text('确认置顶？');
        tip.modal('show');
        $('.operate-sure').click(function(){
            $.post(url,function(data){
                if(data=='yes'){
                    tip.find('.result-tip').text('操作成功！');
                    that.text('操作成功');
                }
                console.log(data);
            });
        });
    });
    $(window).bind("scroll", function(){ //返回顶部
        var top = $(this).scrollTop(); // 当前窗口的滚动距离
        if(top>1000){
            $('#returnTop').show();
        }else{
            $('#returnTop').hide();
        }
    });
    $("#returnTop").click(function () {//返回顶部
        var speed=1000;//滑动的速度
        $('body,html').animate({ scrollTop: 0 }, speed);
        return false;
    });
    //function tip(text){
    //    var tip=$('#operate-tip');
    //    tip.find('.result-tip').text(text);
    //    tip.find('.operate-sure').hide();
    //    tip.modal('show');
    //    setTimeout(function(){
    //        tip.modal('hide');
    //    },2000);
    //}
});