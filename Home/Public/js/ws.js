/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//多说插件js
$(function(){
    var duoshuoQuery = {short_name:"qdbrother"};
    (function() {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';ds.async = true;
            ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0] 
             || document.getElementsByTagName('body')[0]).appendChild(ds);
    })();
});
//句子评论
$(function(){
    $(function(){
        //点击登录弹出/隐藏登录框/
        var flag = 0;
        $("#loginin").click(function(){
            var v=$(this).text();
                v=="登陆"?$(this).text("未登录"):$(this).text("登陆");
            $("#login").toggleClass("yinchang");
        });
    });
});
//悬浮导航条	
$(function(){
    showScroll();
    function showScroll(){
        $(window).scroll( function() { 
            var scrollValue=$(window).scrollTop();
            scrollValue > 100 ? $('ul[id=scroll]').fadeIn():$('ul[id=scroll]').fadeOut();
            if(scrollValue > 100){
                    $('#header-top').addClass('scorllTopCss');

                    $('#site-nav').addClass('scrollSiteNavCss');
                    $('#site-nav').css({'z-index':1000})	
            }else{
                    $('#header-top').removeClass('scorllTopCss');
                    $('#header-top').css({'top':0});

                    $('#site-nav').removeClass('scrollSiteNavCss');				
            }
        } );	
        $('#scroll1').click(function(){
                $("html,body").animate({scrollTop:0},500);	
        });	
        $('#scroll2').click(function(){
                $("html,body").animate({scrollTop:$(document).height()},500);	
        });	
    };
});