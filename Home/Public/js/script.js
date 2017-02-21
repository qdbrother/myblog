/**
 * script v1.0 by Ality.
 */

$(document).ready(function(){
    get_tabs('1');
    // 搜索
    $("#header-search, #body-search").click(function(){
        return false;
    });
    $("#header-search").hover(function(){
        $(".search-sort-list").show();
    },function(){
        $(".search-sort-list").hide();
    });
    $("#body-search").hover(function(){
        $("#search-content-list").show();
    },function(){
        $("#search-content-list").hide();
    });
    $("#s").blur(function(){
        var val = $(this).val();
        if(val !== '')
        {
            location.href = 'article-'+val+'-0.html';
        }
    }).keyup(function(){
        //alert(event.keyCode);
        var val = $("#s").val();
        if(event.keyCode === 13 && val !== ''){
            location.href = 'article-'+val+'-0.html';
        }
    });
    $("#search-sort-list li").click(function(){
        if($(this).text() === '内容')
        {
            $("#s").show();
            $("#body-search").hide();
        }
        else
        {
            $("#s").hide();
            $(".tab_search").text('请选择...');
            $("#body-search").show();
        }
        $(".search-sort-txt").text($(this).text());
        $(".search").val($(this).val());
        $("#search-sort-list").hide();
        var id=$(".search").val();
        get_tabs(id);
        
    });

    // 引用
    $(".backs").click(function(){
	$(".track").slideToggle("slow");
	return false;
    });
    
    // 迷你菜单
    $('#simple-menu').sidr();
    $('#simple-menu-s').sidr();
    
    // 链接图标
    $(".content-main p a, .content-main ul li a, .content-main ol li a").each(function() {
        if ($(this).children('img').length <= 0) {
            $(this).append('<i class="icon-link"></i>');
        }
    });
    
    // 文字展开
    $(".showmore span").click(function(e){
	$(this).html(["▼", "▲"][this.hutia^=1]);
	$(this.parentNode.parentNode).next().slideToggle();
	e.preventDefault();
    });
    
    // 滚屏
    $('.scroll_t').click(function () {
	$('html,body').animate({
            scrollTop: '0px'
	}, 800);
    });
    $('.scroll_c').click(function () {
	$('html,body').animate({
            scrollTop: $('.nav-single').offset().top
 	}, 800);
    });
    $('.scroll_b').click(function () {
	$('html,body').animate({
            scrollTop: $('.site-info').offset().top
	}, 800);
    });
    
    // 去边线
    $(".message-widget li:last, .message-page li:last, .hot_commend li:last").css("border","none");
    
    // 图片延迟
    $(".content-main img, .thumbnail img, #comments img").lazyload({
	effect: "fadeIn",
	failurelimit: 10
    });
    
    // 表情
    $('.smiley').click(function () {
	$('.smiley-box').animate({
            opacity: 'toggle',
            left: '50px'
	}, 1000).animate({
            left: '10px'
	}, 'fast');
	return false;
    });
    
    // 弹窗
    $('#login-main').leanModal({
	top: 110,
	overlay: 0.6,
	closeButton: '.hidemodal'
    });
    $('#logint-main').leanModal({
	top: 110,
	overlay: 0.6,
	closeButton: '.hidemodal'
    });
    $('#share-main').leanModal({
	top: 110,
	overlay: 0.6,
	closeButton: '.hidemodal'
    });
    $('#share-main-s').leanModal({
	top: 110,
	overlay: 0.6,
	closeButton: '.hidemodal'
    });
    
    // 字号
    $(".bigger, .smaller").click(function(){
	var thisEle = $(".content-main").css("font-size"); 
	var textFontSize = parseFloat(thisEle , 10);
	var unit = thisEle.slice(-2);
	var cName = $(this).attr("class");
	if(cName == "bigger"){
            textFontSize += 2;
	}else if(cName == "smaller"){
            textFontSize -= 2;
	}
	$(".content-main").css("font-size",  textFontSize + unit );
    });
    
    // 结束
});

// 弹窗
(function ($) {
    $.fn.extend({
        leanModal: function (options) {
            var defaults = {
                top: 100,
                overlay: 0.5,
                closeButton: null
            };
            var overlay = $('<div id=\'lean_overlay\'></div>');
            $('body').append(overlay);
            options = $.extend(defaults, options);
            return this.each(function () {
                var o = options;
                $(this).click(function (e) {
                    var modal_id = $(this).attr('href');
                    $('#lean_overlay').click(function () {
                        close_modal(modal_id);
                    });
                    $(o.closeButton).click(function () {
                        close_modal(modal_id);
                    });
                    var modal_height = $(modal_id).outerHeight();
                    var modal_width = $(modal_id).outerWidth();
                    $('#lean_overlay').css({
                        'display': 'block',
                        opacity: 0
                    });
                    $('#lean_overlay').fadeTo(200, o.overlay);
                    $(modal_id).css({
                        'display': 'block',
                        'position': 'fixed',
                        'opacity': 0,
                        'z-index': 11000,
                        'left': 50 + '%',
                        'margin-left': - (modal_width / 2) + 'px',
                        'top': o.top + 'px'
                    });
                    $(modal_id).fadeTo(200, 1);
                    e.preventDefault();
                });
            });
            function close_modal(modal_id) {
                $('#lean_overlay').fadeOut(200);
                $(modal_id).css({
                    'display': 'none'
                });
            }
        }
    })
}) (jQuery);

// 链接复制
function copy_code(text) {
    if (window.clipboardData) {
        window.clipboardData.setData("Text", text);
	alert("已经成功将原文链接复制到剪贴板！");
    } else {
	var x=prompt('你的浏览器可能不能正常复制\n请您手动进行：',text);
    }
};

// 评论贴图
function embedImage() {
    var URL = prompt('请输入图片 URL 地址:', 'http://');
    if (URL) {
        document.getElementById('comment').value = document.getElementById('comment').value + '[img]' + URL + '[/img]';
    }
};

// 表情
function grin(tag) {
    var myField;
    tag = ' ' + tag + ' ';
    if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
        myField = document.getElementById('comment');
    } else {
        return false;
    }
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
    }
    else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = endPos;
        myField.value = myField.value.substring(0, startPos)
                + tag
                + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
    } else {
        myField.value += tag;
        myField.focus();
    }
};

// 跟随
$.fn.rollFloat = function() {
    var position = function(element) {
        var top = element.position().top;
        var pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 45
                    });
                } else {
                    element.css({ 
                        top: scrolls
                    });
                }
            } else {
                element.css({
                    position: pos, 
                    top: top
                });
            }
        });
    }; 
    return $(this).each(function() {
        position($(this));
    });
};
$(function(){
    $(".sidebar-roll").rollFloat();
});

// 顶部导航
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top;
        var pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 0
                    }).addClass("shadow");
                } else {
                    element.css({ 
                        top: scrolls
                    });
                }
            }else {
                element.css({
                    position: pos, 
                    top: top 
                }).removeClass("shadow");
            }
        });
    }; 
    return $(this).each(function() {
        position($(this));
    });
};
$(function(){
    $("#header-top").smartFloat();
});

// 文字滚动
function ScrollImgLeft() {
    var speed = 30;
    var scroll_begin = document.getElementById('bulletin_begin');
    var scroll_end = document.getElementById('bulletin_end');
    var scroll_div = document.getElementById('bulletin_div');
    scroll_end.innerHTML = scroll_begin.innerHTML;
    function Marquee() {
        if (scroll_end.offsetWidth - scroll_div.scrollLeft <= 0)
            scroll_div.scrollLeft -= scroll_begin.offsetWidth;
        else
            scroll_div.scrollLeft++;
    }
    var MyMar = setInterval(Marquee, speed);
    scroll_div.onmouseover = function () {
        clearInterval(MyMar);
    }
    scroll_div.onmouseout = function () {
        MyMar = setInterval(Marquee, speed);
    }
}

// 喜欢
$.fn.postLike = function() {
    if (jQuery(this).hasClass('done')) {
        return false;
    } else {
        $(this).addClass('done');
        var id = $(this).data("id"),
		action = $(this).data('action'),
		rateHolder = jQuery(this).children('.count');
        var ajax_data = {
            action: "ality_ding",
            um_id: id,
            um_action: action
        };
        $.post(wpl_ajax_url, ajax_data,
        function(data) {
            jQuery(rateHolder).html(data);
        });
        return false;
    }
};
$(document).on("click", ".favorite",
function() {
    $(this).postLike();
});

// 图片延迟
eval(
        function(p,a,c,k,e,d)
{
    e=function(c)
    {
        return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36));
    };
    if(!''.replace(/^/,String)){
        while(c--)
        {
            d[e(c)]=k[c]||e(c);
        }
        k=[function(e){return d[e];}];
        e=function(){return'\\w+';};
        c=1;
    }
    while(c--)
    {
        if(k[c]){
            p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);
        }
    }
    return p;
}('(5($){$.J.L=5(r){8 1={d:0,A:0,b:"h",v:"N",3:4};6(r){$.D(1,r)}8 m=9;6("h"==1.b){$(1.3).p("h",5(b){8 C=0;m.t(5(){6(!$.k(9,1)&&!$.l(9,1)){$(9).z("o")}j{6(C++>1.A){g B}}});8 w=$.M(m,5(f){g!f.e});m=$(w)})}g 9.t(5(){8 2=9;$(2).c("s",$(2).c("i"));6("h"!=1.b||$.k(2,1)||$.l(2,1)){6(1.u){$(2).c("i",1.u)}j{$(2).K("i")}2.e=B}j{2.e=x}$(2).T("o",5(){6(!9.e){$("<V />").p("X",5(){$(2).Y().c("i",$(2).c("s"))[1.v](1.Z);2.e=x}).c("i",$(2).c("s"))}});6("h"!=1.b){$(2).p(1.b,5(b){6(!2.e){$(2).z("o")}})}})};$.k=5(f,1){6(1.3===E||1.3===4){8 7=$(4).F()+$(4).O()}j{8 7=$(1.3).n().G+$(1.3).F()}g 7<=$(f).n().G-1.d};$.l=5(f,1){6(1.3===E||1.3===4){8 7=$(4).I()+$(4).U()}j{8 7=$(1.3).n().q+$(1.3).I()}g 7<=$(f).n().q-1.d};$.D($.P[\':\'],{"Q-H-7":"$.k(a, {d : 0, 3: 4})","R-H-7":"!$.k(a, {d : 0, 3: 4})","S-y-7":"$.l(a, {d : 0, 3: 4})","q-y-7":"!$.l(a, {d : 0, 3: 4})"})})(W);',62,62,'|settings|self|container|window|function|if|fold|var|this||event|attr|threshold|loaded|element|return|scroll|src|else|belowthefold|rightoffold|elements|offset|appear|bind|left|options|original|each|placeholder|effect|temp|true|of|trigger|failurelimit|false|counter|extend|undefined|height|top|the|width|fn|removeAttr|lazyload|grep|show|scrollTop|expr|below|above|right|one|scrollLeft|img|jQuery|load|hide|effectspeed'.split('|'),0,{}));

$("html,body").on("click",function(e){
    anp(e);
});
/*连续点击特效--右键键*/
$('html,body').mousedown(function(e){
    if(e.which === 3)
    {
        anp(e);
    }            
});

function anp(e){
    if(e.which === 1)
    {
        var n=Math.round(Math.random()*100);
    }
    else{
        var n="你想干嘛";
    }
    var $i=$("<b onselectstart='return false;' style='position:relative;z-index:9999;'>").text(n);
    var x=e.pageX,y=e.pageY;
    $i.css({top:y-20,left:x,position:"absolute",color:"RGB(51,255,51)"});
    $("body").append($i);
    $i.animate({top:y-180,opacity:0,"font-size":"2em"},1500,function(){
        $i.remove();
    });
    e.stopPropagation();
}
//获取li的值
function setValueToSpan(id, name){
    $(".tab_search").text(name);
    $(".search_1").val(id);
    var search_val = $(".search").val();
    var flag_group = 0;
    var flag_tab = 0;
    if(search_val === '1')
    {
        flag_group = parseInt(id);
    }
    else if(search_val === '2')
    {
        flag_tab = parseInt(id);
    }
    $("#search-content-list").hide();
    if(flag_group === 6)
    {
        location.href = 'juzi-0-0.html';//跳转到search页面
    }
    else
    {
        location.href = 'article-'+flag_group+'-'+flag_tab+'-0.html';//跳转到search页面
    }
}

function get_tabs(id)
{
    $.ajax({
        type: "post",
        url: "index.php/Home/Index/get_tabs",
        data: {id:id},
        dataType: "json",
        success: function(data){
            if(id === '1')
            {
                $("#search-content-list").html('');
                $.each(data,function(k,v){
                    $("#search-content-list").append(
                            "<li onclick=\"setValueToSpan("+v.group_id+",'"+v.group_name+"')\" value=\""+v.group_id+"\">"+v.group_name+"</li>"
                            );
                });
            }
            else if(id === '2')
            {
                $("#search-content-list").html('');
                $.each(data,function(k,v){
                    $("#search-content-list").append(
                            "<li onclick=\"setValueToSpan("+v.tab_id+",'"+v.tab_name+"')\" value=\""+v.tab_id+"\">"+v.tab_name+"</li>"
                            );
                });
            }
        }
    });
}