<?php
    extract($_GET);
    $file_path = $article_id ? './static/content/article-'.$article_id.'.shtml' : './static/content/article-1.shtml';
    if(file_exists($file_path) && filemtime($file_path)+3600 >= time())
    {
        echo file_get_contents($file_path);
        exit(0);
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>{$info.article_title}--青岛小哥 - 个人主页|SEO优化|内容管理系统|网站开发|企业网站|GPS定位系统</title>
    <meta name="description" content="专注于技术开发,分享行业内最新动态,热衷地学习各种流行技术" />
    <meta name="keywords" content="个人博客,网站开发,APP软件,个人主页,ERP管理系统,考勤管理系统,人员定位系统,IT资讯,技术交流,资源分享,微信开发,网站优化,seo排名,企业网站,商城网站,内容管理系统,青岛小哥" />
    <link rel="shortcut icon" href="<?php echo IMG_URL;?>/fa.jpg"/>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo IMG_URL;?>/fa.jpg" />
    <link rel='stylesheet' id='style-css'  href='/Home/Public/css/style.css' type='text/css' media='all' />
	<link rel='stylesheet' id='mediaqueries-css'  href='<?php echo CSS_URL;?>/mediaqueries.css' type='text/css' media='all' />
	<script type='text/javascript' src='<?php echo JS_URL;?>/jquery-1.7.2.min.js'></script>
	<script src="<?php echo JS_URL;?>/ws.js"></script>
	<script src="<?php echo JS_URL;?>/script.js"></script>
	<script type='text/javascript' src='<?php echo JS_URL;?>/jquery.sidr.min.js'></script>
    <script>
        $(document).ready(function(){
            var ip = $('#ip').val();
            if($('#article_id').val())
            {
                var id = $('#article_id').val();
                var data = {'ip':ip,'article_id':id};
            }
            else
            {
                var id = $('#sentence_id').val();
                var data = {'ip':ip,'sentence_id':id};
            }
            $.post("index.php/Home/Index/ip",data);
        });
    </script>
</head>
<body class="home blog" ondragstart="window.event.returnValue=false" oncontextmenu="window.event.returnValue=false" onselectstart="event.returnValue=false">
<div id="page" class="page-site">
	<div id="simple-top">
		<a id="simple-menu" href="#sidr"><i class="icon-simple-menu"></i></a>
	</div>
    <header id="header">
        <div class="main-header">
            <hgroup class="logo-main">
                <a href="<?php echo MYBLOG_URL;?>" title="回到首页"><img src="/Home/Public/images/logo.png" alt="Logo" title="Logo" height="80px"></a>
            </hgroup>				
            <div id="search">
                <div id="header-search" class="search-sort">
                    <div class="search-left">
                        <span class="search-sort-txt">分类</span>
                        <em></em>
                    </div>
                    <input type="hidden" name="type" id="search" class="search" value="1">
                    <ul id="search-sort-list" class="search-sort-list" style="display: none;">
                            <li value="1">分类</li>
                            <li value="2">标签</li>
                    </ul>
                </div>
                <div id="body-search">
                    <span class="tab_search" id="tab-search" style="display: inline-block">请选择...</span>
                    <input type="hidden" name="type" id="search_1" class="search_1" value="1">
                    <ul id="search-content-list" class="search-content-list" style="display: none;">
                    </ul>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <nav id="site-nav" class="main-nav">
            <div>
                    <ul class="menu">
                        <li class="main-li">
                            <a href="<?php echo MYBLOG_URL;?>" class="main-li-a">博客首页</a>
                        </li>
                        <foreach name="menu_group" item="v_group">
                            <if condition="$v_group.group_name eq '句子迷'">
                                <li class="main-li">
                                <a href="juzi-0-0.html" class="main-li-a">{$v_group.group_name}</a>
                                <ul class="sub-menu">
                                <foreach name="menu_tab" item="v_tab">
                                    <if condition="$v_tab.group_id eq $v_group['group_id']">
                                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-261">
                                            <a href="juzi-{$v_tab.tab_id}-0.html">{$v_tab.tab_name}</a>
                                        </li>
                                    </if>
                                </foreach>
                                </ul>
                                </li>
                            <else />
                                <li class="main-li">
                                    <a href="article-{$v_group.group_id}-0-0.html" class="main-li-a">{$v_group.group_name}</a>
                                    <ul class="sub-menu">
                                <foreach name="menu_tab" item="v_tab">
                                    <if condition="$v_tab.group_id eq $v_group['group_id']">
                                        <li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-261">
                                            <a href="article-{$v_group.group_id}-{$v_tab.tab_id}-0.html">{$v_tab.tab_name}</a>
                                        </li>
                                    </if>
                                </foreach>
                                    </ul>
                                </li>
                            </if>
                        </foreach>
                        <li class="main-li">
                             <a href="chat.html" class="main-li-a">留言板</a>
                            <ul class="sub-menu"></ul>
                        </li>

                    </ul>
                </div>			
            <ul><li class="fill"></li></ul>
        </nav>
        <div class="clear"></div>
    </header>
    <div id="main" class="wrapper">
        <nav class="crumbs">现在位置：
            <a href="<?php echo MYBLOG_URL;?>" rel="nofollow" title="首页"> 首页 ></a>
            <foreach name="menu_group" item="v_group">
                <if condition="$v_group.group_id eq $info['group_id']">
                    <a href="article-{$v_group.group_id}-0-0.html" rel="nofollow" title="{$info.group_name}">{$v_group.group_name}</a>
                </if>
            </foreach>
            > {$info.article_title}
        </nav>
        <div class="clear"></div>
        <div id="primary" class="site-content">
            <div class="single-content">
                <article id="post-391" class="post-391 post type-post status-publish format-standard hentry category-uncategorized category-5 tag-25">
                    <div class="fontsize"><span class="smaller" >字体-</span><span class="bigger" >字体+</span></div>
                    <header class="single-header">
                        <h1 class="single-title">{$info.article_title}</h1>
                        <div class="single-meta">
                            <span class="date"><i class="icon-date"></i><?php echo date('Y-m-d H:i:s',$info['create_time']);?></span>
                            <span class="cat"><i class="icon-cat"></i>
                                <a href="article-{$info.group_id}-0-0.html" rel="category">
                                    <foreach name="menu_group" item="v_group">
                                        <if condition="$info.group_id eq $v_group['group_id']">
                                            {$v_group.group_name}
                                        </if>
                                    </foreach>
                                </a>
                            </span>
                            <span class="views"><i class="icon-views"></i>访问量 </span><span id="pv">{$info.pv}</span>
                        </div>
                    </header>
                    <div class="single-main">
                            <div class="content-main">
                                {$info.article_content}
                                <nav id="pagenavi" style="text-align: center;margin: 10px;float:none;"></nav>			
                            </div>
                            <div class="clear"></div>
                    </div>
                </article>
                <input type="hidden" id="ip" value="<?php echo $_SERVER["REMOTE_ADDR"];?>"/>
                <input type="hidden" id="article_id" value="{$info.article_id}"/>
            </div>
            <div class="single-tag">
                <div class="bdsharebuttonbox">
                    <a href="#" class="bds_more" data-cmd="more"></a>
                    <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                    <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a>
                    <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
                    <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                    <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                    <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                    <a href="#" class="bds_tieba" data-cmd="tieba" title="分享到百度贴吧"></a>
                    <a href="#" class="bds_isohu" data-cmd="isohu" title="分享到我的搜狐"></a>
                    <a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a>
                </div>
                <script>
                    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};
                    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                </script>
            </div>
            <div class="single-tag">标签：
                <foreach name="menu_tab" item="v_tab">
                    <in name="v_tab.tab_id" value="$info['tab_ids']"><a href="article-{$info.group_id}-{$v_tab.tab_id}-0.html">{$v_tab.tab_name}</a>&nbsp;&nbsp;</in>
                </foreach>
            </div>
            <div class="authorbio">
                原文来自：<a  href="article-{$info.article_id}.html" target="_blank" rel="from">http://www.qdaobrother.cn/<?php echo $info['title'];?></a>，转载请注明出处，谢谢【<a href="/">青岛小哥</a>】
            </div>
            <!-- #content -->
            <div class="authorbio">
                本页关键字：暂无
            </div>
            <div id="single-widget">
                <div class="clear"></div>
            </div>
            <!-- 多说评论框 start -->
	<div class="ds-thread" data-thread-key="{$info.article_id}" data-title="{$info.article_title}" data-url="http://www.qdaobrother.cn/article-{$info.article_id}.html"></div>
        <!-- 多说评论框 end -->
        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
            var duoshuoQuery = {short_name:"qdbrother"};
            (function() {
                    var ds = document.createElement('script');
                    ds.type = 'text/javascript';ds.async = true;
                    ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                    ds.charset = 'UTF-8';
                    (document.getElementsByTagName('head')[0] 
                     || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
	</script><!-- 多说公共JS代码 end -->
        </div>
        <div id="sidebar" class="widget-area">
            <aside id="text-8" class="widget widget_text">
                <h3 class="widget-title"><p><i class="icon-st"></i></p>扫一扫加我微信</h3>			
                <div class="textwidget">
                    <img src="/Home/Public/images/weixin_logo.jpg" alt="加好友" title="加好友" width="300px"/>
                </div>
                <div class="clear"></div>
            </aside>		
            <aside id="text-3" class="widget widget_text"><h3 class="widget-title"><p><i class="icon-st"></i></p>其他联系信息</h3>			
                <div class="textwidget">
                    <li style="margin-bottom: 5px;list-style: none;">
                        <img src="/Home/Public/images/qq.jpg" style="position: relative;top: 5px; margin-right: 5px;" alt="QQ企鹅图像" title="QQ企鹅图像" width="20px">我的QQ（开发版）：1099202246
                    </li>
                    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1099202246&site=qq&menu=yes">
                        <img border="0" src="/Home/Public/images/talk_qq.gif" alt="点击这里给我发消息" title="点击这里给我发消息"/>
                    </a>
                </div>
                <div class="clear"></div>
            </aside>
            <aside id="tag_cloud-2" class="widget widget_tag_cloud">
                <h3 class="widget-title"><p><i class="icon-st"></i></p>标签云</h3>
                <div class="tagcloud">
                    <ul class="tag-ul">
                        <foreach name="info_tab_article" item="v_tab">
                            <li class="table-label"><a href="article-0-{$v_tab.tab_id}-0.html" title="{$v_tab.tab_name}">{$v_tab.tab_name}</a></li>
                        </foreach>
                        <foreach name="info_tab_sentence" item="v_tab">
                            <li class="table-label"><a href="juzi-{$v_tab.tab_id}-0.html" title="{$v_tab.tab_name}">{$v_tab.tab_name}</a></li>
                        </foreach>
                    </ul>
		</div>
		<div class="clear"></div></aside>	
		<aside id="recent-posts-2" class="widget widget_recent_entries">		
                    <h3 class="widget-title"><p><i class="icon-st"></i></p>近期文章</h3>		
                        <ul>
                            <foreach name="new_article" item="v_new" key="i">
                                <li>
                                    <span class="li-icon li-icon-1">{$i+++1}</span><a href="article-{$v_new.article_id}.html" target="_self" title="{$v_new.article_title}">{$v_new.article_title}</a>
                                </li>
                            </foreach>
                        </ul>
                    <div class="clear"></div>
		</aside>
		<aside id="hot_post-2" class="widget widget_hot_post"><h3 class="widget-title"><p><i class="icon-st"></i></p>热门文章</h3>
                    <div id="hot_post_widget">
                        <ul>
                            <foreach name="top_article" item="v_top" key="i">
                                <li>
                                    <span class="li-icon li-icon-1">{$i+++1}</span><a href="article-{$v_top.article_id}.html" target="_self" title="{$v_top.article_title}">{$v_top.article_title}</a>
                                </li>
                            </foreach>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </aside>		
                <aside id="text-8" class="widget widget_text">
                    <h3 class="widget-title"><p><i class="icon-st"></i></p>最近访客</h3>			
                    <div class="textwidget">
                        <ul class="ds-recent-visitors" data-num-items="24" data-avatar-size="35"></ul>
                        <!--多说js加载开始，一个页面只需要加载一次 -->
                        <script type="text/javascript">
                            var duoshuoQuery = {short_name:"qdbrother"};
                            (function() {
                                var ds = document.createElement('script');
                                ds.type = 'text/javascript';ds.async = true;
                                ds.src = 'http://static.duoshuo.com/embed.js';
                                ds.charset = 'UTF-8';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
                            })();
                        </script>
                        <!--多说js加载结束，一个页面只需要加载一次 -->
                    </div>
                    <div class="clear"></div>
                </aside>
                <div class="sidebar-roll" style="position: static; top: 3389px;"></div>
            </div>
            <div class="clear"></div>
            <div id="links" style="width: 1060px;margin: 0 auto;margin-bottom: 20px;">
                <ul>
                    <li><a href="http://www.qdaobrother.cn/" target="_blank">个人博客</a></li>
                    <li><a href="http://www.dawnfly.cn" target="_blank">破晓起飞博客</a></li>
                    <li><a href="http://www.115yz.com/" target="_blank">云笔记</a></li>
                    <li><a href="http://www.lexiang123.cn/" target="_blank">乐享博客</a></li>
                    <li><a href="http://www.loveteemo.com/" target="_blank">青春博客</a></li>
                    <li><a href="http://qiusongsong.net/dh/" target="_blank">邱嵩松博客</a></li>
                    <li><a href="http://www.ydstudios.com/" target="_blank">Sam博客</a></li>
                    <li><a href="http://www.onmpw.com/" target="_blank">迹忆博客</a></li>
                    <li><a href="http://www.tianjianlong.com.cn/" target="_blank">轮回博客</a></li>
                    <li><a href="http://www.huxinchun.com/" target="_blank">胡新春博客</a></li>
                    <li><a href="http://www.shuyong.net/links.html" target="_blank">舍力博客</a></li>
                    <li><a href="http://www.chen101.cn" target="_blank">柒爱博客</a></li>
                    <li><a href="http://www.ezhihao.com/" target="_blank">易智豪软件工作室</a></li>
                    <li><a href="http://www.hao7di.com/" target="_blank">好基地</a></li>
                    <li><a href="http://www.xuexiaofeng.com" target="_blank">风色幻想</a></li>
                    <li><a href="http://www.jinxinblog.com" target="_blank">鑫落佈格</a></li>
                    <li><a href="http://www.njphper.com" target="_blank">凝聚博客</a></li>
                    <li><a href="http://www.onlyni.com" target="_blank">小倪博客</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <embed src="http://www.xiami.com/widget/253032479_1769089294,_235_346_FF8719_494949_1/multiPlayer.swf" type="application/x-shockwave-flash" width="235" height="0" wmode="opaque"></embed>
            <footer id="footer" style="width: 1080px;margin: 0 auto;">
                <div id="site-info">		
                    <span class="info-add">
                        本站是基于ThinkPHP3.2.3版本开发 网站归【<a href="<?php echo MYBLOG_URL;?>">青岛小哥</a>】所有 并保留所有权利 鲁ICP备16018162号 
						<script type="text/javascript">
							var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
							document.write(unescape("%3Cspan id='cnzz_stat_icon_1260849231'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1260849231%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
						</script>
                    </span>
                </div>
                <div id="sidr" style="display: none;" class="sidr left">
					<a id="simple-menu-s" href="#sidr"><i class="icon-close"></i></a>
					<div class="menu-container">
						<ul id="menu-1" class="menu">
							<foreach name="menu_group" item="v_group">
								<if condition="$v_group.group_name eq '句子迷'">
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-257">
										<a href="juzi-0-0.html">{$v_group.group_name}</a>
									</li>
								<else />
									<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-257">
										<a href="article-{$v_group.group_id}-0-0.html">{$v_group.group_name}</a>
									</li>
								</if>
							</foreach>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-257">
										<a href="chat.html">留言板</a>
								</li>
						</ul>
					</div>
				</div>
                <ul id="scroll" style="display:none;">
                        <li><a class="scroll_t" id="scroll1" title="返回顶部"><i class="icon-scroll_t"></i></a></li>
                        <li><a class="scroll_b" id="scroll2" title="转到底部"><i class="icon-scroll_b"></i></a></li>
                </ul>
            </footer>
        </div>
</body>
</html>
<?php
    $ob_str = ob_get_contents();
    file_put_contents($file_path, $ob_str);
?>
