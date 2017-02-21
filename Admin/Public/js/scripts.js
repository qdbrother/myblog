$(function ()
{
    //  点击更换验证码
    $('#verifyCode').click(function ()
    {
        $(this).attr('src', 'verify?rand=' + Math.random());
    });

    var checkName = 0;
    var checkPwd = 0;
    $('#username').blur(function ()
    {
        var that = $(this);
        if (that.val() == '')
        {
            that.next().removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
                .parent().parent().removeClass('has-success').addClass('has-error');
            return;
        }

        //  ajax 验证用户名
        $.post('ajaxCheckName', {username: that.val()}, function (msg)
        {
            if (msg == '1')
            {
                that.next().removeClass('glyphicon glyphicon-remove').addClass('glyphicon glyphicon-ok')
                    .parent().parent().removeClass('has-error').addClass('has-success');
                checkName = 1;
                //  调用确定按钮激活函数
                activeSubmit();
            } else
            {
                that.next().removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
                    .parent().parent().removeClass('has-success').addClass('has-error');
                checkName = 0;
            }
        }, 'html');
    });

    $('#password').keyup(function (e)
    {
        if (e.which == 9) {
            return;
        }
        if ($(this).val() == '')
        {
            $(this).next().removeClass('glyphicon glyphicon-ok').addClass('glyphicon glyphicon-remove')
                .parent().parent().removeClass('has-success').addClass('has-error');
            $('button[type=submit]').attr('disabled', 'disabled').removeClass('btn-warning').addClass('btn-default');
            checkPwd = 0;
        } else
        {
            $(this).next().removeClass('glyphicon glyphicon-remove')
                .parent().parent().removeClass('has-error');
            checkPwd = 1;
            activeSubmit();
        }
    });

    /*
     * 确定按钮激活函数
     */
    function activeSubmit()
    {
        if (checkName && checkPwd)
        {
            $('button[type=submit]').removeAttr('disabled').removeClass('btn-default').addClass('btn-warning');
        }
    }
    /*
     * 点击切换标签
     */
    $("#group_id").change(function(){
        var val = $(this).find("option:selected").val();
        var type = $("#type").val();
        if(val)
        {
            $.ajax({  
                type:'post',      
                url:"/index.php/Admin/Tab/tab",
                data:{'val':val,'type':type},  
                cache:false,  
                dataType:'json',  
                success:function(data){
                    $("#tab_add").html("");
                    $.each(data,function(k,v){
                        $("#tab_add").append(
                                "<input type=\"checkbox\" name=\"tab_ids[]\" value=\""+v.tab_id+"\"/>"+v.tab_name
                        );
                    });
                }  
            });
        }
    });
});